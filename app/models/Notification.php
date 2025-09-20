<?php
namespace app\models;

require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';
require __DIR__ . '/../PHPMailer/src/Exception.php';


use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Notification {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    /**
     * Génère un message automatique selon le type
     * @param string $type "acceptation" ou "rejet"
     * @return string
     */
    public static function message($type) {
        if (strtolower($type) === "acceptation") {
            return "Félicitations 🎉, vous passez à l'étape suivante de la sélection !";
        } else {
            return "Malheureusement 😔, votre candidature n’a pas été retenue cette fois.";
        }
    }

    /**
     * Envoie une notification et l'enregistre en base
     */
  public function sendNotification($idCandidat, $type) {
        // Récupération email candidat
        $sql = "SELECT Mail FROM Candidat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $idCandidat]);
        $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$candidat) return false;

        $to = $candidat['Mail'];
        $message = self::message($type);

        // ⚡ PHPMailer
        $mail = new PHPMailer(true);
       try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mandresystanley@gmail.com';
    $mail->Password = 'jkhx adtf yxde rxkt';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('mandresystanley@gmail.com', 'Communication Team');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = "Notification sur le recrutement";
    $mail->Body    = $message;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->send();

    echo "✅ Mail envoyé avec succès";
} catch (Exception $e) {
    echo "❌ Erreur lors de l'envoi : {$mail->ErrorInfo}";
}

        // Enregistrer en base
        $insert = $this->db->prepare("
            INSERT INTO Notification (idCandidat, Date_envoi, Messages, Motif, Status) 
            VALUES (:idCandidat, NOW(), :msg, :motif, :status)
        ");

        $insert->execute([
            'idCandidat' => $idCandidat,
            'msg'        => $message,
            'motif'      => $type,
            'status'     => 'non lu'
        ]);

        return true;
    }
}








?>