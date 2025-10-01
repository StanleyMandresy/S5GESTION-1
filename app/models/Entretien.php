<?php
namespace app\models;

use PDO;
use Exception;

class Entretien {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

public function getEntretiens() {
    $sql = "SELECT e.id, c.Nom, e.Date_heure_debut, e.Date_heure_fin, e.Presence, e.Notes 
            FROM Entretien e 
            JOIN candidates c ON e.idCandidat = c.id";
    $stmt = $this->db->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $events = [];
    foreach ($rows as $row) {
        $events[] = [
            'id' => $row['id'],
  
            'Nom' => $row['Nom'],
            'start' => $row['Date_heure_debut'],
            'end' => $row['Date_heure_fin'],
            'presence' => $row['Presence'],
            'note' => $row['Notes']
        ];
    }

    return $events;
}
public function PlanifierEntretien($idCandidat, $date_heure_debut, $job_offer_id, $duree = 60, $type_entretien = 'presentiel') {
    $entretienModel = new Entretien($this->db);

    // Calcul de la fin basé sur la durée
    $date_heure_fin = date('Y-m-d H:i:s', strtotime($date_heure_debut . " +{$duree} minutes"));

    // 1️⃣ Vérifier qu'il n'y a pas déjà d'entretien pour ce candidat sur cette offre
    $sqlDouble = "SELECT COUNT(*) as nb
    FROM Entretien
    WHERE idCandidat = :idCandidat
    AND idOffre = :job_offer_id";
    $stmtDouble = $this->db->prepare($sqlDouble);
    $stmtDouble->execute([
        'idCandidat' => $idCandidat,
        'job_offer_id' => $job_offer_id
    ]);
    $nbEntretiens = $stmtDouble->fetch(PDO::FETCH_ASSOC)['nb'];

    if ($nbEntretiens > 0) {
        return ['success' => false, 'message' => 'Ce candidat a déjà un entretien pour cette offre'];
    }

    // 2️⃣ Vérifier qu'il n'y a pas déjà 3 entretiens ce jour
    $sqlCount = "SELECT COUNT(*) as nb
    FROM Entretien
    WHERE DATE(Date_heure_debut) = DATE(:date)";
    $stmtCount = $this->db->prepare($sqlCount);
    $stmtCount->execute(['date' => $date_heure_debut]);
    $nb = $stmtCount->fetch(PDO::FETCH_ASSOC)['nb'];

    if ($nb >= 3) {
        return ['success' => false, 'message' => 'Limite de 3 entretiens par jour atteinte'];
    }

    // 3️⃣ Vérifier chevauchement
    $sqlOverlap = "SELECT * FROM Entretien
    WHERE Date_heure_debut < :fin AND Date_heure_fin > :debut";
    $stmtOverlap = $this->db->prepare($sqlOverlap);
    $stmtOverlap->execute([
        'debut' => $date_heure_debut,
        'fin'   => $date_heure_fin
    ]);
    if ($stmtOverlap->rowCount() > 0) {
        return ['success' => false, 'message' => 'Chevauchement avec un autre entretien'];
    }

    // 4️⃣ Insérer l'entretien avec tous les champs
    $sqlInsert = "INSERT INTO Entretien (idCandidat,idOffre , Date_heure_debut, Date_heure_fin,  Presence, Notes)
    VALUES (:idCandidat, :job_offer_id, :debut, :fin, NULL, NULL)";
    $stmtInsert = $this->db->prepare($sqlInsert);
    $stmtInsert->execute([
        'idCandidat' => $idCandidat,
        'job_offer_id' => $job_offer_id,
        'debut'      => $date_heure_debut,
        'fin'        => $date_heure_fin,


    ]);

    return ['success' => true, 'message' => 'Entretien planifié avec succès'];
}
public function updateEntretien($id, $note, $remarques, $presence) {
    $sql = "UPDATE Entretien 
            SET Notes = :note, Remarques = :remarques, Presence = :presence 
            WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        'note' => $note,
        'remarques' => $remarques,
        'presence' => $presence,
        'id' => $id
    ]);
}

public function updateNotesRH($idEntretien, $noteRH) {
    try {
        $this->db->beginTransaction();

        // 1. Mettre à jour la note RH de l'entretien
        $sql = "UPDATE Entretien SET NotesRH = :noteRH WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':noteRH' => $noteRH,
            ':id' => $idEntretien
        ]);

        // 2. Récupérer l'idCandidat lié à cet entretien
        $sqlCandidat = "SELECT idCandidat FROM Entretien WHERE id = :id";
        $stmtC = $this->db->prepare($sqlCandidat);
        $stmtC->execute([':id' => $idEntretien]);
        $idCandidat = $stmtC->fetchColumn();

        if ($idCandidat) {
            // 3. Passer le candidat au stade 4
            $sqlUpdateStade = "UPDATE candidat_avance SET stade = 4 WHERE idcandidat = :idcandidat";
            $stmtU = $this->db->prepare($sqlUpdateStade);
            $stmtU->execute([':idcandidat' => $idCandidat]);
        }

        $this->db->commit();
        return true;

    } catch (Exception $e) {
        $this->db->rollBack();
        error_log("Erreur updateNotesRH: " . $e->getMessage());
        return false;
    }
}


}
    
  



    

?>
