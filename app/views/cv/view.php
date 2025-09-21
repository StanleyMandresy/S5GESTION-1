<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Paysagiste - <?php echo htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? ''); ?> <?php echo htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? ''); ?></title>
    <!-- Tailwind CSS & DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-alt: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark: #859393;
            --color-darker: #5D726F;
        }
        
        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .cv-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid var(--color-darker);
        }
        
        .cv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(93, 114, 111, 0.2);
        }
        
        .profile-img {
            transition: all 0.5s ease;
            border: 5px solid var(--color-light-alt);
            box-shadow: 0 8px 16px rgba(93, 114, 111, 0.3);
        }
        
        .profile-img:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 20px rgba(93, 114, 111, 0.4);
            border-color: var(--color-darker);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--color-darker);
        }
        
        .floating-leaves {
            position: absolute;
            width: 100px;
            height: 100px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23859393'%3E%3Cpath d='M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
            animation: float 15s infinite ease-in-out;
        }
        
        .floating-leaves:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .floating-leaves:nth-child(2) {
            top: 25%;
            right: 5%;
            animation-delay: -5s;
        }
        
        .floating-leaves:nth-child(3) {
            bottom: 15%;
            left: 10%;
            animation-delay: -10s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(5deg);
            }
            66% {
                transform: translateY(10px) rotate(-5deg);
            }
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: var(--color-light-alt);
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background-color: var(--color-darker);
            border-radius: 4px;
            transition: width 1.5s ease-in-out;
        }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .leaf-bg {
            background-color: var(--color-medium);
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%235d726f' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="min-h-screen py-8 px-4 md:py-12 md:px-8">
    <!-- Animated background elements -->
    <div class="floating-leaves"></div>
    <div class="floating-leaves"></div>
    <div class="floating-leaves"></div>
    
    <div class="max-w-4xl mx-auto bg-white rounded-2xl overflow-hidden shadow-2xl">
        
        <!-- Header Section -->
        <header class="leaf-bg text-white py-8 px-6 md:px-10 relative">
            <div class="absolute top-4 right-4 opacity-20">
                <i class="bi bi-flower3 text-6xl"></i>
            </div>
            
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <div class="flex-shrink-0">
                    <img src="/<?php echo htmlspecialchars($cv['photo_path']); ?>" 
                         alt="Photo de <?php echo htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? ''); ?>" 
                         class="profile-img w-40 h-40 md:w-48 md:h-48 rounded-full object-cover mx-auto">
                </div>
                
                <div class="text-center md:text-left flex-grow">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 animate-on-scroll">
                        <?php echo htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? ''); ?> 
                        <span class="text-white"><?php echo htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? ''); ?></span>
                    </h1>
                    <h2 class="text-xl md:text-2xl font-semibold mb-4 animate-on-scroll" style="color: var(--color-darker);">
                        <?php echo htmlspecialchars($cv['titre_poste'] ?? ''); ?>
                    </h2>
                    <p class="text-lg max-w-xl mx-auto md:mx-0 animate-on-scroll">
                        <?php echo htmlspecialchars($cv['description'] ?? ''); ?>
                    </p>
                </div>
                <div class="flex justify-center my-8">
    <a href="/cv/exportpdf?id=<?php echo htmlspecialchars($cv['cv_id'] ?? $cv['id'] ?? $cv['id'] ?? ''); ?>" target="_blank" class="btn btn-lg bg-[#5D726F] text-white hover:bg-[#859393] transition-all duration-300 transform hover:scale-105 shadow-lg">
        <i class="bi bi-file-earmark-pdf-fill"></i>
        Exporter en PDF
    </a>
</div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6 md:p-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Experience -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-briefcase-fill" style="color: var(--color-darker);"></i>
                        Expérience Professionnelle
                    </h3>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-[#CED0C3] rounded-full flex items-center justify-center">
                                <i class="bi bi-tree-fill text-xl" style="color: var(--color-darker);"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Paysagiste Expérimenté</h4>
                                <p class="text-sm opacity-75"><?php echo htmlspecialchars($cv['experience_year'] ?? ''); ?> années d'expérience</p>
                                <p class="mt-2">Expert en aménagement paysager, conception de jardins et entretien d'espaces verts.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Education -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-book-half" style="color: var(--color-darker);"></i>
                        Formation
                    </h3>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-[#CED0C3] rounded-full flex items-center justify-center">
                                <i class="bi bi-mortarboard-fill text-xl" style="color: var(--color-darker);"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg"><?php echo htmlspecialchars($cv['diploma_name'] ?? ''); ?></h4>
                                <p class="text-sm opacity-75">Niveau: <?php echo htmlspecialchars($cv['level'] ?? $cv['experience_level'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-person-badge-fill" style="color: var(--color-darker);"></i>
                        À propos
                    </h3>
                    <p class="mb-4"><?php echo htmlspecialchars($cv['atout'] ?? ''); ?></p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-coin text-xl" style="color: var(--color-darker);"></i>
                            <span>Salaire souhaité: <?php echo htmlspecialchars($cv['salaire_souhaite'] ?? ''); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="bi bi-clock text-xl" style="color: var(--color-darker);"></i>
                            <span>Horaires: <?php echo htmlspecialchars($cv['horaires'] ?? ''); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="bi bi-award text-xl" style="color: var(--color-darker);"></i>
                            <span>Avantages: <?php echo htmlspecialchars($cv['avantages'] ?? ''); ?></span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Contact -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-person-lines-fill" style="color: var(--color-darker);"></i>
                        Contact
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#CED0C3] rounded-full flex items-center justify-center">
                                <i class="bi bi-envelope-fill" style="color: var(--color-darker);"></i>
                            </div>
                            <a href="mailto:<?php echo htmlspecialchars($cv['Mail']?? ''); ?>" class="hover:underline">
                                <?php echo htmlspecialchars($cv['Mail']?? ''); ?>
                            </a>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#CED0C3] rounded-full flex items-center justify-center">
                                <i class="bi bi-telephone-fill" style="color: var(--color-darker);"></i>
                            </div>
                            <a href="tel:<?php echo htmlspecialchars($cv['phone'] ?? $cv['telephone'] ?? ''); ?>" class="hover:underline">
                                <?php echo htmlspecialchars($cv['phone'] ?? $cv['telephone'] ?? ''); ?>
                            </a>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#CED0C3] rounded-full flex items-center justify-center">
                                <i class="bi bi-geo-alt-fill" style="color: var(--color-darker);"></i>
                            </div>
                            <span><?php echo htmlspecialchars($cv['address'] ?? $cv['location'] ?? ''); ?></span>
                        </div>
                    </div>
                </section>

                <!-- Languages -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-translate" style="color: var(--color-darker);"></i>
                        Langues
                    </h3>
                    <div class="space-y-4">
                        <?php 
                        if (!empty($cv['languages'])) {
                            $languages = explode(',', $cv['languages']);
                            foreach ($languages as $language) {
                                $lang = trim($language);
                                echo '<div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium">' . htmlspecialchars($lang) . '</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: ' . rand(80, 100) . '%"></div>
                                    </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </section>

                <!-- Skills -->
                <section class="cv-card bg-base-100 p-6 rounded-box shadow-md animate-on-scroll">
                    <h3 class="section-title text-2xl font-bold flex items-center gap-2">
                        <i class="bi bi-tools" style="color: var(--color-darker);"></i>
                        Compétences
                    </h3>
                    <div class="space-y-4">
                        <!-- Skill 1 -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">Conception paysagère</span>
                                <span>95%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 95%"></div>
                            </div>
                        </div>
                        <!-- Skill 2 -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">Plantation & Entretien</span>
                                <span>90%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 90%"></div>
                            </div>
                        </div>
                        <!-- Skill 3 -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">Gestion de projet</span>
                                <span>85%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer class="leaf-bg text-white py-6 px-10 text-center">
            <p class="text-lg font-medium"><?php echo htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? ''); ?> <?php echo htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? ''); ?> - Paysagiste Passionné</p>
            <div class="flex justify-center gap-4 mt-4">
                <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                    <i class="bi bi-linkedin" style="color: white;"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                    <i class="bi bi-envelope-fill" style="color: white;"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition">
                    <i class="bi bi-file-earmark-person-fill" style="color: white;"></i>
                </a>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bars
            setTimeout(() => {
                document.querySelectorAll('.progress-fill').forEach(bar => {
                    bar.style.width = bar.style.width;
                });
            }, 500);
            
            // Scroll animation
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });
            
            animatedElements.forEach(element => {
                observer.observe(element);
            });
            
            // Add subtle hover effect to cards
            const cards = document.querySelectorAll('.cv-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                    card.style.boxShadow = '0 12px 20px rgba(93, 114, 111, 0.2)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                });
            });
        });
    </script>
</body>
</html>