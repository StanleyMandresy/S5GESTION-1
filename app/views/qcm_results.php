<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats QCM - Entreprise de Paysagiste</title>
    
    <!-- Daisy UI & Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-alt: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark-alt: #859393;
            --color-dark: #5D726F;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--color-light);
            color: var(--color-dark);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        .hero-bg {
            background: linear-gradient(rgba(93, 114, 111, 0.7), rgba(93, 114, 111, 0.7)), 
                        url('https://images.unsplash.com/photo-1545205597-3d9d02c29597?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
        
        .card-bg {
            background-color: var(--color-light-alt);
        }
        
        .table-header {
            background-color: var(--color-dark);
            color: white;
        }
        
        .table-row:nth-child(even) {
            background-color: var(--color-light);
        }
        
        .table-row:nth-child(odd) {
            background-color: var(--color-light-alt);
        }
        
        .btn-primary {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--color-dark-alt);
            border-color: var(--color-dark-alt);
        }
        
        .leaf-decoration {
            color: var(--color-dark);
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <!-- Header avec navigation -->
    <header class="navbar bg-base-100 shadow-md">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/qcm">QCM</a></li>
                    <li><a href="/resultats" class="active">Résultats</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl" href="/">
                <i class="bi bi-tree-fill text-green-700 mr-2"></i>
                VertDesign
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="/">Accueil</a></li>
                <li><a href="/qcm">QCM</a></li>
                <li><a href="/resultats" class="active">Résultats</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a href="/login" class="btn btn-outline btn-primary">Connexion</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero min-h-[40vh] hero-bg text-white">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Résultats du QCM</h1>
                <p class="mb-5">Consultez les performances de tous les candidats</p>
                <div class="flex justify-center space-x-4">
                    <i class="bi bi-flower1 text-3xl leaf-decoration"></i>
                    <i class="bi bi-tree text-3xl leaf-decoration"></i>
                    <i class="bi bi-flower2 text-3xl leaf-decoration"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto my-8 px-4">
        <!-- Statistiques -->
        <div class="stats shadow w-full mb-8">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <i class="bi bi-people-fill text-3xl"></i>
                </div>
                <div class="stat-title">Nombre de candidats</div>
                <div class="stat-value text-primary" id="candidateCount"><?php echo count($results); ?></div>
                <div class="stat-desc">Total participants au QCM</div>
            </div>
            
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="bi bi-graph-up-arrow text-3xl"></i>
                </div>
                <div class="stat-title">Score moyen</div>
                <div class="stat-value text-secondary" id="averageScore">0</div>
                <div class="stat-desc">Performance moyenne des candidats</div>
            </div>
            
            <div class="stat">
                <div class="stat-figure text-accent">
                    <i class="bi bi-trophy-fill text-3xl"></i>
                </div>
                <div class="stat-title">Meilleur score</div>
                <div class="stat-value text-accent" id="topScore">0</div>
                <div class="stat-desc">Performance maximale atteinte</div>
            </div>
        </div>

        <!-- Tableau des résultats -->
        <div class="card bg-base-100 shadow-xl mb-8">
            <div class="card-body">
                <h2 class="card-title justify-center mb-6">
                    <i class="bi bi-table text-primary mr-2"></i>
                    Détails des résultats
                </h2>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="text-center">
                                    <i class="bi bi-person-badge mr-2"></i>
                                    ID Candidat
                                </th>
                                <th class="text-center">
                                    <i class="bi bi-star-fill mr-2"></i>
                                    Score total
                                </th>
                                <th class="text-center">
                                    <i class="bi bi-award mr-2"></i>
                                    Performance
                                </th>
                                <th class="text-center">
                                    <i class="bi bi-bar-chart-fill mr-2"></i>
                                    Graphique
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row): ?>
                            <tr class="table-row">
                                <td class="text-center font-semibold">
                                    <?php echo htmlspecialchars($row['idCandidat']); ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-lg badge-primary">
                                        <?php echo htmlspecialchars($row['totalPoints']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $score = intval($row['totalPoints']);
                                    if ($score >= 80) {
                                        echo '<span class="badge badge-success gap-1"><i class="bi bi-trophy"></i> Excellent</span>';
                                    } elseif ($score >= 60) {
                                        echo '<span class="badge badge-info gap-1"><i class="bi bi-check-circle"></i> Bon</span>';
                                    } elseif ($score >= 40) {
                                        echo '<span class="badge badge-warning gap-1"><i class="bi bi-exclamation-triangle"></i> Moyen</span>';
                                    } else {
                                        echo '<span class="badge badge-error gap-1"><i class="bi bi-x-circle"></i> Insuffisant</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <div class="radial-progress text-primary" style="--value:<?php echo $score; ?>; --size:3rem; --thickness: 4px;" role="progressbar">
                                        <?php echo $score; ?>%
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Graphique des performances -->
        <div class="card bg-base-100 shadow-xl mb-8">
            <div class="card-body">
                <h2 class="card-title justify-center mb-6">
                    <i class="bi bi-bar-chart-line text-primary mr-2"></i>
                    Vue d'ensemble des performances
                </h2>
                <div class="w-full h-64 bg-base-200 rounded-lg flex items-center justify-center">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-center space-x-4 mt-8">
            <a href="/" class="btn btn-primary btn-wide">
                <i class="bi bi-house-door-fill mr-2"></i>
                Retour à l'accueil
            </a>
            <button class="btn btn-outline btn-primary btn-wide" onclick="window.print()">
                <i class="bi bi-printer-fill mr-2"></i>
                Imprimer les résultats
            </button>
            <button class="btn btn-outline btn-primary btn-wide" id="exportBtn">
                <i class="bi bi-download mr-2"></i>
                Exporter en PDF
            </button>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer footer-center p-10 bg-base-200 text-base-content rounded mt-12">
        <aside>
            <div class="flex items-center justify-center mb-4">
                <i class="bi bi-tree-fill text-3xl text-green-700 mr-2"></i>
                <p class="text-2xl font-bold">VertDesign</p>
            </div>
            <p class="font-bold">
                Entreprise de paysagiste <br>Création et entretien d'espaces verts depuis 2005
            </p>
            <p>Copyright © 2023 - Tous droits réservés</p>
        </aside>
        <nav>
            <div class="grid grid-flow-col gap-4">
                <a><i class="bi bi-twitter text-xl"></i></a>
                <a><i class="bi bi-facebook text-xl"></i></a>
                <a><i class="bi bi-instagram text-xl"></i></a>
            </div>
        </nav>
    </footer>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Calcul des statistiques
        document.addEventListener('DOMContentLoaded', function() {
            const results = <?php echo json_encode($results); ?>;
            const scores = results.map(result => parseInt(result.totalPoints));
            
            // Calcul du score moyen
            const averageScore = scores.reduce((a, b) => a + b, 0) / scores.length;
            document.getElementById('averageScore').textContent = averageScore.toFixed(1);
            
            // Calcul du meilleur score
            const topScore = Math.max(...scores);
            document.getElementById('topScore').textContent = topScore;
            
            // Graphique des performances
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const candidateIds = results.map(result => result.idCandidat);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: candidateIds,
                    datasets: [{
                        label: 'Score des candidats',
                        data: scores,
                        backgroundColor: '#5D726F',
                        borderColor: '#5D726F',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Score (%)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'ID Candidat'
                            }
                        }
                    }
                }
            });
            
            // Simulation d'export PDF
            document.getElementById('exportBtn').addEventListener('click', function() {
                alert('Fonctionnalité d\'export PDF en cours de développement');
            });
        });
    </script>
</body>
</html>