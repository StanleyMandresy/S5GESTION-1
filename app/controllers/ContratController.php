<?php
namespace app\controllers;
use PDO;

require_once __DIR__ . '/../pdf/fpdf.php';
class ContratController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function generatePDF() {



        $idCandidat = $_POST['idCandidat'] ?? null;
        $idJobOffer = $_POST['job_offer_id'] ?? null;

        if (!$idCandidat || !$idJobOffer) {
            echo "Erreur : idCandidat et job_offer_id requis";
            return;
        }

        // Récupérer les infos candidat
        $stmt = $this->db->prepare("
        SELECT c.Nom, c.Prenom, c.Mail, c.phone, c.address, cv.date_depot
        FROM candidates c
        LEFT JOIN candidate_cv_data cv ON cv.candidate_id = c.id AND cv.job_offer_id = :idJobOffer
        WHERE c.id = :idCandidat
        ");
        $stmt->execute([
            ':idCandidat' => $idCandidat,
            ':idJobOffer' => $idJobOffer
        ]);
        $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$candidat) {
            echo "Candidat introuvable";
            return;
        }

        // Récupérer infos offre
        $stmt2 = $this->db->prepare("
        SELECT title, locations, diploma_id, level, experience_year
        FROM job_offers
        WHERE id = :idJobOffer
        ");
        $stmt2->execute([':idJobOffer' => $idJobOffer]);
        $job = $stmt2->fetch(PDO::FETCH_ASSOC);

        if (!$job) {
            echo "Offre introuvable";
            return;
        }

        // Générer PDF


        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0,10,'Contrat d\'essai',0,1,'C');

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(10);
        $pdf->Cell(0,8,"Nom: {$candidat['Nom']}",0,1);
        $pdf->Cell(0,8,"Prenom: {$candidat['Prenom']}",0,1);
        $pdf->Cell(0,8,"Email: {$candidat['Mail']}",0,1);
        $pdf->Cell(0,8,"Poste: {$job['title']}",0,1);
        $pdf->Cell(0,8,"Lieu: {$job['locations']}",0,1);
        $pdf->Cell(0,8,"Date Depot CV: {$candidat['date_depot']}",0,1);

        $pdf->Ln(10);
        $pdf->MultiCell(0,6,"Ce contrat d'essai est établi entre la société et le candidat pour une période d'essai selon les termes convenus.",0,'L');

        $pdf->Output('I','Contrat_'.$candidat['Nom'].'_'.$job['title'].'.pdf');
    }
}
