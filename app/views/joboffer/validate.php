<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des offres d'emploi | Paysagistes Experts</title>
    <!-- Tailwind CSS & Daisy UI -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-alt: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark: #859393;
            --color-darker: #5D726F;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9faf9;
            color: var(--color-darker);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23b4bab1' fill-opacity='0.2' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: var(--color-darker);
        }
        
        .hero-pattern {
            background-color: rgba(212, 222, 214, 0.5);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%235d726f' fill-opacity='0.09'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .btn-validate {
            background-color: var(--color-darker);
            color: white;
            transition: all 0.3s;
        }
        
        .btn-validate:hover {
            background-color: var(--color-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(93, 114, 111, 0.3);
        }
        
        .btn-reject {
            background-color: #e2b6b3;
            color: #7c3c38;
            transition: all 0.3s;
        }
        
        .btn-reject:hover {
            background-color: #d8a29e;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(125, 62, 58, 0.2);
        }
        
        .table-row {
            transition: all 0.3s ease;
        }
        
        .table-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(93, 114, 111, 0.15);
        }
        
        .animate-grow {
            animation: grow 0.5s ease-out;
        }
        
        @keyframes grow {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .status-validated {
            background-color: rgba(163, 195, 171, 0.2);
            color: #2e5942;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .status-pending {
            background-color: rgba(255, 215, 158, 0.3);
            color: #8a6118;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .status-rejected {
            background-color: rgba(235, 180, 178, 0.3);
            color: #943936;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(100%);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background-color: #47b881;
        }
        
        .notification.error {
            background-color: #f25c5c;
        }
        
        .floating-leaves {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }
        
        .leaf {
            position: absolute;
            background-size: cover;
            opacity: 0.3;
            z-index: -1;
        }
        
        .leaf-1 {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%235D726F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z'/%3E%3Cpath d='M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12'/%3E%3C/svg%3E");
            top: 15%;
            left: 5%;
            width: 40px;
            height: 40px;
            animation: float 25s infinite ease-in-out;
        }
        
        .leaf-2 {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23859393' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M2 22c1.25-.987 2.27-1.975 3.9-2.2a5.56 5.56 0 0 1 3.8 1.5 4 4 0 0 0 6.187-2.353 3.5 3.5 0 0 0 3.69-5.116A3.5 3.5 0 0 0 20.95 8 3.5 3.5 0 1 0 16 3.05a3.5 3.5 0 0 0-5.831 1.373 3.5 3.5 0 0 0-5.116 3.69 4 4 0 0 0-2.348 6.155C3.499 15.42 4.409 16.712 4.2 18.1 3.926 19.743 3.014 20.732 2 22'/%3E%3Cpath d='M2 22 17 7'/%3E%3C/svg%3E");
            top: 25%;
            right: 10%;
            width: 50px;
            height: 50px;
            animation: float 30s infinite ease-in-out 2s;
        }
        
        .leaf-3 {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23B4BAB1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 10c-3 0-4-3-4-3s1 0 2-1 2-2 2-2c-2 4-4 6-5 7-1 1-2 3-2 3s5 1 7 1 6-1 7-1c-1-1-2-2-2-3-1-1-3-3-5-7 0 0 1 1 2 2s2 1 2 1-1 3-4 3Z'/%3E%3Cpath d='M12 10v12'/%3E%3Cpath d='M9 22h6'/%3E%3C/svg%3E");
            bottom: 20%;
            left: 15%;
            width: 35px;
            height: 35px;
            animation: float 35s infinite ease-in-out 4s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            25% {
                transform: translateY(-20px) rotate(5deg);
            }
            50% {
                transform: translateY(10px) rotate(-5deg);
            }
            75% {
                transform: translateY(-10px) rotate(2deg);
            }
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Floating leaves decoration -->
    <div class="floating-leaves">
        <div class="leaf leaf-1"></div>
        <div class="leaf leaf-2"></div>
        <div class="leaf leaf-3"></div>
    </div>

    <!-- Header Section -->
    <header class="hero-pattern py-8 px-4 md:px-8 rounded-b-2xl shadow-md">
        <div class="container mx-auto max-w-6xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <i class="bi bi-tree-fill text-4xl text-darker"></i>
                    <h1 class="text-3xl font-bold">Paysagistes Experts</h1>
                </div>
                <div class="flex items-center gap-2">
                    <div class="avatar online">
                        <div class="w-12 h-12 rounded-full">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%235D726F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='12' cy='7' r='4'/%3E%3C/svg%3E" />
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold">Service RH</p>
                        <p class="text-sm text-darker">Administrateur</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto max-w-6xl py-10 px-4 md:px-8">
        <div class="mb-10 text-center animate-slide-in">
            <h2 class="text-4xl font-bold mb-4">Validation des offres d'emploi</h2>
            <p class="text-lg text-dark max-w-2xl mx-auto">Gérez et validez les nouvelles offres d'emploi pour votre entreprise de paysagisme.</p>
        </div>

        <!-- Notification Area -->
        <div id="notification" class="notification">
            <i class="bi bi-check-circle-fill text-xl"></i>
            <span class="notification-message"></span>
        </div>

        <?php if(empty($offers)): ?>
        <!-- Empty State -->
        <div class="card bg-base-100 shadow-xl max-w-2xl mx-auto animate-grow">
            <div class="card-body text-center py-16">
                <i class="bi bi-inbox text-6xl text-medium mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Aucune offre à valider</h3>
                <p class="text-dark mb-6">Toutes les offres d'emploi ont été traitées ou aucune nouvelle offre n'a été soumise.</p>
                <button class="btn btn-validate mx-auto">
                    <i class="bi bi-plus-circle"></i>
                    Créer une nouvelle offre
                </button>
            </div>
        </div>
        <?php else: ?>
        <!-- Offers Table -->
        <div class="bg-base-100 rounded-2xl shadow-lg overflow-hidden animate-grow">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-light-alt">
                            <th class="text-darker font-semibold">Titre</th>
                            <th class="text-darker font-semibold">Lieu</th>
                            <th class="text-darker font-semibold">Date limite</th>
                            <th class="text-darker font-semibold">Statut</th>
                            <th class="text-darker font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($offers as $index => $offer): ?>
                        <tr class="table-row hover:bg-light-alt/50" style="animation-delay: <?= $index * 0.05 ?>s">
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="bg-light p-2 rounded-lg">
                                        <i class="bi bi-briefcase text-darker text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold"><?= htmlspecialchars($offer['title']) ?></p>
                                        <p class="text-sm text-dark">Créée le <?= date('d/m/Y', strtotime($offer['created_at'] ?? 'now')) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-dark"><?= htmlspecialchars($offer['locations']) ?></td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-calendar-event text-darker"></i>
                                    <span class="<?= (strtotime($offer['deadline']) < time()) ? 'text-error font-semibold' : 'text-dark' ?>">
                                        <?= $offer['deadline'] ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <?php if($offer['is_approved'] == 1): ?>
                                <span class="status-validated">
                                    <i class="bi bi-check-circle"></i> Validée
                                </span>
                                <?php elseif($offer['is_approved'] == 0): ?>
                                <span class="status-pending">
                                    <i class="bi bi-clock"></i> En attente
                                </span>
                                <?php else: ?>
                                <span class="status-rejected">
                                    <i class="bi bi-x-circle"></i> Refusée
                                </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <!-- Formulaire pour valider -->
                                    <form class="action-form" action="/offers/validate" method="post">
                                        <input type="hidden" name="id" value="<?= $offer['id'] ?>">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-validate">
                                            <i class="bi bi-check-lg"></i> Valider
                                        </button>
                                    </form>

                                    <!-- Formulaire pour refuser -->
                                    <form class="action-form" action="/offers/validate" method="post">
                                        <input type="hidden" name="id" value="<?= $offer['id'] ?>">
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" class="btn btn-sm btn-reject">
                                            <i class="bi bi-x-lg"></i> Refuser
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="mt-20 py-8 px-4 md:px-8 bg-darker text-light">
        <div class="container mx-auto max-w-6xl text-center">
            <div class="flex justify-center gap-6 mb-6">
                <a href="#" class="text-2xl text-light hover:text-light-alt transition"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-2xl text-light hover:text-light-alt transition"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-2xl text-light hover:text-light-alt transition"><i class="bi bi-linkedin"></i></a>
            </div>
            <p>© 2023 Paysagistes Experts. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Notification system
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            const icon = notification.querySelector('i');
            const messageEl = notification.querySelector('.notification-message');
            
            // Set notification content
            messageEl.textContent = message;
            
            // Set notification style based on type
            notification.className = 'notification';
            if (type === 'success') {
                notification.classList.add('success');
                icon.className = 'bi bi-check-circle-fill text-xl';
            } else if (type === 'error') {
                notification.classList.add('error');
                icon.className = 'bi bi-exclamation-circle-fill text-xl';
            }
            
            // Show notification with animation
            notification.classList.add('show');
            
            // Hide after 5 seconds
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }

        // Check URL for validation parameter
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('validation')) {
                const status = urlParams.get('validation');
                if (status === 'success') {
                    showNotification('Offre validée avec succès!', 'success');
                } else if (status === 'error') {
                    showNotification('Erreur lors de la validation de l\'offre.', 'error');
                }
            }
            
            // Add animations to table rows
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.classList.add('animate-slide-in');
            });
            
            // Add confirmation to action buttons
            const actionForms = document.querySelectorAll('.action-form');
            actionForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button');
                    const action = button.textContent.includes('Valider') ? 'valider' : 'refuser';
                    
                    if (!confirm(`Êtes-vous sûr de vouloir ${action} cette offre?`)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>