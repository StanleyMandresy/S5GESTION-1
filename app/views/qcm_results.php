<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du QCM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-light: #F5F5F1;
            --color-light-accent: #E6E6E2;
            --color-medium: #B4BAB1;
            --color-dark-accent: #859393;
            --color-dark: #5D726F;
        }

        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 50px 20px;
            text-align: center;
        }

        h2 {
            color: var(--color-dark);
            margin-bottom: 30px;
            font-weight: 700;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--color-dark-accent);
        }

        strong {
            color: var(--color-dark);
            font-size: 1.4rem;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            background-color: var(--color-dark-accent);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a:hover {
            background-color: var(--color-dark);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <h2>Résultat du QCM</h2>

    <p>Candidat ID : <strong><?php echo htmlspecialchars($idCandidat); ?></strong></p>
    <p>Score total obtenu : <strong><?php echo htmlspecialchars($score); ?></strong></p>

    <a href="/"><i class="fas fa-home me-1"></i>Retour à l'accueil</a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
