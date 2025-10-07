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

        // Récupérer les infos candidat (VOS REQUETES EXISTANTES)
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

        // Récupérer infos offre (VOS REQUETES EXISTANTES)
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

        // Générer PDF amélioré
        $pdf = new \FPDF();
        $pdf->AddPage();

        // En-tête professionnel
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 0, 128);
        $pdf->Cell(0, 15, 'CONTRAT DE TRAVAIL - PERIODE D\'ESSAI', 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 8, 'Conclu en application des articles L. 1242-1 et suivants du Code du travail', 0, 1, 'C');
        $pdf->Ln(15);

        // Entreprise
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ENTRE L\'EMPLOYEUR :', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "[Nom de l'entreprise]\n[Adresse de l'entreprise]\n[Numéro SIRET]\nReprésenté par : [Nom du responsable]", 0, 'L');

        $pdf->Ln(10);

        // Salarié
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ET LE SALARIE :', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, "Nom : " . htmlspecialchars($candidat['Nom']), 0, 1);
        $pdf->Cell(0, 6, "Prénom : " . htmlspecialchars($candidat['Prenom']), 0, 1);
        $pdf->Cell(0, 6, "Adresse : " . htmlspecialchars($candidat['address']), 0, 1);
        $pdf->Cell(0, 6, "Email : " . htmlspecialchars($candidat['Mail']), 0, 1);
        $pdf->Cell(0, 6, "Téléphone : " . htmlspecialchars($candidat['phone']), 0, 1);
        $pdf->Cell(0, 6, "Date de dépôt de candidature : " . ($candidat['date_depot'] ?? 'Non spécifiée'), 0, 1);

        $pdf->Ln(12);

        // Article 1 - Emploi
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 1 - EMPLOI', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Le salarié est engagé en qualité de : " . htmlspecialchars($job['title']) . "\n\nLieu de travail principal : " . htmlspecialchars($job['locations']) . "\n\nClassification : Niveau " . ($job['level'] ?? 'Non spécifié'), 0, 'J');

        $pdf->Ln(8);

        // Article 2 - Durée
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 2 - DUREE DU CONTRAT', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Le présent contrat est conclu pour une durée déterminée de __________ mois.\n\nDate de début : __________\nDate de fin : __________\n\nMotif du recours au CDD : [Accroissement temporaire d'activité / Remplacement / etc.]", 0, 'J');

        $pdf->Ln(8);

        // Article 3 - Période d'essai
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 3 - PERIODE D\'ESSAI', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Une période d'essai de __________ est prévue.\n\nDurant cette période, chaque partie peut rompre le contrat sans préavis ni indemnité.\n\nLa période d'essai peut être renouvelée une fois pour une durée identique.", 0, 'J');

        $pdf->Ln(8);

        // Article 4 - Rémunération
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 4 - REMUNERATION', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Salaire mensuel brut : __________ €\n\nVersement : Mensuel, à terme échu\n\nPrime d'ancienneté : Selon accord d'entreprise\n\nAvantages en nature : [Préciser le cas échéant]", 0, 'J');

        $pdf->Ln(8);

        // Article 5 - Horaires
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 5 - TEMPS DE TRAVAIL', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Durée légale du travail : 35 heures par semaine\n\nHoraires de travail : [Préciser les horaires]\n\nJours de travail : Du lundi au vendredi\n\nRégime des heures supplémentaires : Conforme à la législation en vigueur", 0, 'J');

        $pdf->Ln(8);

        // Article 6 - Congés
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 6 - CONGES PAYES', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Le salarié bénéficie de 2,5 jours ouvrables de congés payés par mois de travail effectif.\n\nPériode de référence : Du 1er juin au 31 mai\n\nModalités de prise : Sur accord de l'employeur", 0, 'J');

        $pdf->Ln(8);

        // Article 7 - Confidentialité
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'ARTICLE 7 - CLAUSE DE CONFIDENTIALITE', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, "Le salarié s'engage à respecter la confidentialité des informations relatives à l'entreprise, ses clients, ses méthodes et son organisation.\n\nCette obligation survit à la termination du présent contrat.", 0, 'J');

        $pdf->Ln(12);

        // Signatures
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(95, 8, 'Fait pour l\'employeur,', 0, 0, 'C');
        $pdf->Cell(95, 8, 'Fait pour le salarié,', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 25, '', 0, 0, 'C');
        $pdf->Cell(95, 25, '', 0, 1, 'C');

        $pdf->Cell(95, 8, '_________________________', 0, 0, 'C');
        $pdf->Cell(95, 8, '_________________________', 0, 1, 'C');

        $pdf->Cell(95, 6, 'Nom, qualité et signature', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Nom et signature', 0, 1, 'C');

        $pdf->Cell(95, 6, 'Le __________', 0, 0, 'C');
        $pdf->Cell(95, 6, 'Le __________', 0, 1, 'C');

        $pdf->Cell(95, 6, 'à __________', 0, 0, 'C');
        $pdf->Cell(95, 6, 'à __________', 0, 1, 'C');

        // Pied de page
        $pdf->SetY(-15);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(128, 128, 128);
        $pdf->Cell(0, 10, 'Document généré le ' . date('d/m/Y à H:i'), 0, 0, 'C');

        // Générer le PDF
        $filename = 'Contrat_Essai_' . htmlspecialchars($candidat['Nom']) . '_' . htmlspecialchars($job['title']) . '.pdf';
        $pdf->Output('I', $filename);
        exit;
    }
}
