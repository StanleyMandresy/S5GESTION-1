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
    <title>Tableau de Bord | Entreprise Paysagiste</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DaisyUI via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-accent: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark-accent: #859393;
            --color-dark: #5D726F;
        }
        
        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--color-dark);
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .welcome-section {
            background: linear-gradient(120deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(93, 114, 111, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
        }
        
        .section-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(93, 114, 111, 0.15);
            padding: 25px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(93, 114, 111, 0.2);
        }
        
        .section-title {
            color: var(--color-dark);
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--color-light-accent);
            padding-bottom: 10px;
        }
        
        .section-title i {
            margin-right: 10px;
            color: var(--color-dark-accent);
        }
        
        .job-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(93, 114, 111, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid var(--color-light-accent);
        }
        
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(93, 114, 111, 0.2);
        }
        
        .job-card-header {
            background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            padding: 15px 20px;
        }
        
        .job-card-body {
            padding: 20px;
        }
        
        .job-detail {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .job-detail i {
            width: 24px;
            color: var(--color-dark-accent);
            margin-right: 10px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(93, 114, 111, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
            color: white;
        }
        
        .btn-primary-custom i {
            margin-right: 8px;
        }
        
        .back-btn {
            color: var(--color-dark);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.7);
        }
        
        .back-btn:hover {
            color: var(--color-dark-accent);
            background-color: rgba(255, 255, 255, 0.9);
            transform: translateX(-5px);
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--color-dark-accent);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .welcome-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- En-tête de bienvenue -->
        <section class="welcome-section animate__animated animate__fadeIn">
            <div class="welcome-content">
                <h1 class="display-4 fw-bold">Bonjour, <?= htmlspecialchars($profile['first_name'].' '.$profile['last_name']) ?> !</h1>
                <p class="lead">Bienvenue sur votre tableau de bord personnel</p>
                <div class="mt-4">
                    <span class="badge bg-light text-dark p-2 me-2">
                        
                    </span>
                    <span class="badge bg-light text-dark p-2">
                        <i class="fas fa-calendar-alt me-1"></i> 
                        <?= date('d/m/Y') ?>
                    </span>
                </div>
            </div>
        </section>

        <!-- Notifications (à compléter) -->
        

        <!-- Offres d'emploi -->
        <section class="section-card animate__animated animate__fadeInUp">
            <h2 class="section-title">
                <i class="fas fa-briefcase"></i> Offres d'emploi du département
            </h2>

            <?php if (!empty($jobOffers)): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($jobOffers as $offer): ?>
                <div class="col">
                    <div class="job-card">
                        <div class="job-card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-briefcase me-2"></i>
                                <?= htmlspecialchars($offer['title']) ?>
                            </h5>
                        </div>
                        <div class="job-card-body">

                            <div class="job-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><strong>Lieu :</strong> <?= htmlspecialchars($offer['locations'] ?? '-') ?></span>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-graduation-cap"></i>
                                <span><strong>Diplôme requis :</strong> <?= htmlspecialchars($offer['name'] ?? '-') ?></span>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-award"></i>
                                <span><strong>Expérience :</strong> <?= htmlspecialchars($offer['experience_year'] ?? '-') ?></span>
                            </div>
                            
                            <div class="job-detail">
                                <i class="fas fa-calendar-day"></i>
                                <span><strong>Date limite :</strong> <?= htmlspecialchars($offer['deadline'] ?? '-') ?></span>
                            </div>
                            
                            <p class="mt-3 text-muted small">
                                <?= nl2br(htmlspecialchars(substr($offer['description'], 0, 150))) ?>...
                            </p>
                            
                            <div class="text-end mt-4">
                                <a href="/cv/job/<?= $offer['id'] ?>" class="btn btn-primary-custom">
                                    <i class="fas fa-eye me-1"></i> Voir les candidatures
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Aucune offre disponible</h4>
                <p>Il n'y a actuellement aucune offre d'emploi dans votre département.</p>
            </div>
            <?php endif; ?>
        </section>

        <!-- Actions RH -->
        <div class="action-buttons">
            <?php if ($Rh != false): ?>
            <a href="/offers/validate" class="btn btn-primary-custom">
                <i class="fas fa-check-circle me-2"></i> Valider demandes d'offres
            </a>
            <?php endif; ?>
            
            <a href="/offers/create" class="btn btn-primary-custom">
                <i class="fas fa-paper-plane me-2"></i> Envoyer demandes d'offres
            </a>
            <a href="/entretien/calendrier" class="btn btn-primary-custom">
                <i class="fas fa-paper-plane me-2"></i> Planifier Entretien
            </a>
            <?php if ($Rh != false): ?>
            <a href="/entretien/listeEntretien" class="btn btn-primary-custom">
            <i class="fas fa-check-circle me-2"></i> Evaluation Entretien
            </a>
            <?php endif; ?>
            <a href="/login" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i> Retour vers Connexion
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation au défilement
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate__animated');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animation = entry.target.getAttribute('data-animation');
                        entry.target.classList.add(animation);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            animatedElements.forEach(element => {
                observer.observe(element);
            });
            
            // Effet de survol amélioré pour les cartes
            const jobCards = document.querySelectorAll('.job-card');
            jobCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-8px)';
                    card.style.boxShadow = '0 12px 25px rgba(93, 114, 111, 0.25)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 5px 15px rgba(93, 114, 111, 0.1)';
                });
            });
        });
    </script>
</body>
</html>
