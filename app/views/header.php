<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Récupérer l'utilisateur depuis la session
$user = $_SESSION['user'] ?? null;

// Redirection si non connecté
if (!$user) {
    header('Location: /login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard <?= htmlspecialchars($user['first_name']) ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind (optionnel) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- CSS global -->
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/header.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(90deg, #6b705c, #cb997e);
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
        }
        .navbar a {
            color: #fff;
            font-weight: 500;
        }
        .btn-profile {
            background-color: #fff;
            color: #6b705c;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        .btn-profile:hover {
            background: #cb997e;
            color: #fff;
            transform: translateY(-2px);
        }
        footer {
            background: linear-gradient(90deg, #6b705c, #cb997e);
            color: #fff;
            padding: 1rem;
            text-align: center;
            margin-top: auto;
        }
        footer a {
            color: #fff;
            text-decoration: underline;
            margin: 0 5px;
        }
        footer a:hover {
            opacity: 0.8;
        }
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar d-flex justify-content-between align-items-center shadow animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="text-white fs-5 fw-semibold">Accueil</a>
            <a href="/profile" class="btn-profile animate__animated animate__pulse animate__infinite">
                <i class="bi bi-person-circle me-1"></i> Mon profil
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="fw-medium">Bonjour, <?= htmlspecialchars($user['first_name']) ?></span>
            <a href="/logout" class="fw-medium text-white text-decoration-underline">Se déconnecter</a>
        </div>
    </nav>
