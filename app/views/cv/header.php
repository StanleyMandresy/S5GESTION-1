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
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- DaisyUI -->
    <script>
        tailwind.config = {
            plugins: [daisyui],
            daisyui: {
                themes: [
                    {
                        paysagiste: {
                            "primary": "#5D726F",
                            "secondary": "#859393",
                            "accent": "#B4BAB1",
                            "neutral": "#CED0C3",
                            "base-100": "#DCDED6",
                        }
                    }
                ]
            }
        }
    </script>

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
            background: linear-gradient(135deg, #DCDED6, #B4BAB1);
        }
        .navbar-custom {
            backdrop-filter: blur(15px);
            background: rgba(93, 114, 111, 0.85);
            border-radius: 1rem;
            padding: 1rem 2rem;
            margin: 1rem auto 2rem auto;
            width: 95%;
            max-width: 1400px;
        }
        .navbar-custom a {
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .navbar-custom a:hover {
            color: #DCDED6 !important;
            transform: translateY(-2px);
        }
        .btn-profile {
            background: #CED0C3;
            color: #5D726F;
            border-radius: 9999px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-profile:hover {
            background: #5D726F;
            color: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            transform: translateY(-3px) scale(1.05);
        }
        .user-greeting {
            font-weight: 600;
            color: #DCDED6;
        }
        .logout-link {
            color: #fff;
            font-weight: 500;
            text-decoration: underline;
            transition: all 0.3s ease;
        }
        .logout-link:hover {
            color: #CED0C3;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom d-flex justify-content-between align-items-center shadow-lg animate__animated animate__fadeInDown">
        <!-- Left side -->
        <div class="d-flex align-items-center gap-4">
            <a href="/" class="text-white fs-5 fw-bold flex items-center gap-2">
                <i class="bi bi-house-door-fill"></i> Accueil
            </a>
            <a href="/profile" class="btn-profile flex items-center gap-2 animate__animated animate__pulse animate__infinite">
                <i class="bi bi-person-circle"></i> Mon profil
            </a>
        </div>

        <!-- Right side -->
        <div class="d-flex align-items-center gap-4">
            <span class="user-greeting flex items-center gap-2">
                <i class="bi bi-flower2"></i> Bonjour, <?= htmlspecialchars($user['first_name']) ?>
            </span>
            <a href="/logout" class="logout-link flex items-center gap-2">
                <i class="bi bi-box-arrow-right"></i> Se déconnecter
            </a>
        </div>
    </nav>
