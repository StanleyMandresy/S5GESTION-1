<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planifier un entretien | VertDesign Paysagiste</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Tailwind CSS avec Daisy UI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-medium: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark-medium: #859393;
            --color-dark: #5D726F;
        }
        
        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%235d726f' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        .hero-bg {
            background: linear-gradient(rgba(93, 114, 111, 0.85), rgba(133, 147, 147, 0.8)), 
                        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25'%3E%3Cdefs%3E%3Cpattern id='p' width='100' height='100' patternUnits='userSpaceOnUse'%3E%3Cpath d='M0 50h100v50H0z' fill='%235d726f' fill-opacity='0.05'/%3E%3Cpath d='M0 0h100v50H0z' fill='%23859393' fill-opacity='0.05'/%3E%3C/pattern%3E%3C/defs%3E%3Crect fill='url(%23p)' width='100%25' height='100%25'/%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(93, 114, 111, 0.15);
            border: 1px solid rgba(220, 222, 214, 0.5);
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.08;
            z-index: 0;
            font-size: 8rem;
        }
        
        .leaf-1 {
            top: 5%;
            left: 5%;
            transform: rotate(15deg);
        }
        
        .leaf-2 {
            bottom: 5%;
            right: 5%;
            transform: rotate(-15deg);
        }
        
        .leaf-3 {
            top: 40%;
            right: 10%;
            transform: rotate(45deg);
            font-size: 6rem;
        }
        
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid var(--color-light-medium);
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .form-input:focus {
            border-color: var(--color-dark);
            box-shadow: 0 0 0 3px rgba(93, 114, 111, 0.2);
            background-color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-dark-medium) 100%);
            border: none;
            transition: all 0.3s ease;
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(93, 114, 111, 0.3);
        }
        
        .calendar-icon {
            color: var(--color-dark);
        }
        
        .success-message {
            background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-dark-medium) 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .candidate-option {
            padding: 12px 15px;
            border-bottom: 1px solid var(--color-light-medium);
            transition: all 0.2s ease;
        }
        
        .candidate-option:hover {
            background-color: var(--color-light);
            padding-left: 20px;
        }
        
        .illustration-container {
            background: linear-gradient(135deg, var(--color-light-medium) 0%, var(--color-medium) 100%);
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--color-dark);
        }
    </style>
</head>
<body>
    <!-- Header avec navigation -->
    <header class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/services">Services</a></li>
                    <li><a href="/projets">Projets</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost normal-case text-xl" href="/">
                <i class="bi bi-tree-fill mr-2" style="color: var(--color-dark);"></i>
                <span style="color: var(--color-dark);">VertDesign</span>
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="/" class="font-medium">Accueil</a></li>
                <li><a href="/services" class="font-medium">Services</a></li>
                <li><a href="/projets" class="font-medium">Projets</a></li>
                <li><a href="/contact" class="font-medium">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a href="/login" class="btn btn-outline btn-sm mr-2" style="border-color: var(--color-dark); color: var(--color-dark);">Connexion</a>
        </div>
    </header>

    <!-- Section principale avec image d'en-tête -->
    <section class="hero min-h-[50vh] hero-bg text-white relative">
        <div class="hero-content text-center">
            <div class="max-w-4xl floating-element">
                <h1 class="mb-5 text-5xl font-bold">Planifier un entretien</h1>
                <p class="mb-5 text-xl">Rencontrez les talents qui façonneront vos espaces verts de demain</p>
                <div class="flex justify-center mt-8">
                    <div class="animate-bounce">
                        <i class="bi bi-chevron-down text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Décorations feuilles -->
        <i class="bi bi-flower1 leaf-decoration leaf-1"></i>
        <i class="bi bi-flower2 leaf-decoration leaf-2"></i>
        <i class="bi bi-tree leaf-decoration leaf-3"></i>
    </section>

    <!-- Section formulaire -->
    <section class="py-16 px-4 relative">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-10 items-start">
                <!-- Illustration et informations -->
                <div class="lg:w-2/5">
                    <div class="illustration-container sticky top-24">
                        <i class="bi bi-calendar2-check feature-icon"></i>
                        <h3 class="text-2xl font-bold mb-4 text-center" style="color: var(--color-dark);">Planification simplifiée</h3>
                        <p class="text-center mb-6">Notre système vous permet de planifier facilement des entretiens avec les candidats les plus prometteurs du secteur paysager.</p>
                        
                        <div class="space-y-4 w-full">
                            <div class="flex items-start">
                                <i class="bi bi-check-circle-fill mr-3 mt-1" style="color: var(--color-dark);"></i>
                                <div>
                                    <h4 class="font-semibold">Processus rapide</h4>
                                    <p class="text-sm">Planification en quelques clics seulement</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="bi bi-check-circle-fill mr-3 mt-1" style="color: var(--color-dark);"></i>
                                <div>
                                    <h4 class="font-semibold">Rappels automatiques</h4>
                                    <p class="text-sm">Notifications envoyées aux candidats</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="bi bi-check-circle-fill mr-3 mt-1" style="color: var(--color-dark);"></i>
                                <div>
                                    <h4 class="font-semibold">Flexibilité horaire</h4>
                                    <p class="text-sm">Adapté à votre emploi du temps</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Formulaire -->
                <div class="lg:w-3/5 form-container p-8 lg:p-10 relative">
                    <h2 class="text-3xl font-bold mb-2 text-center" style="color: var(--color-dark);">
                        <i class="bi bi-calendar-check mr-2"></i>Planifier un entretien
                    </h2>
                    <p class="text-center mb-8" style="color: var(--color-dark-medium);">Remplissez les informations ci-dessous pour planifier un entretien</p>
                    
                    <form method="POST" action="/entretien/create" id="entretienForm" class="space-y-6">
                        <!-- Sélection du candidat -->
                        <div class="form-control">
                            <label for="idCandidat" class="label">
                                <span class="label-text font-semibold text-lg">
                                    <i class="bi bi-person-badge mr-2 calendar-icon"></i>Candidat :
                                </span>
                            </label>
                            <select name="idCandidat" id="idCandidat" class="select select-bordered w-full form-input p-3 rounded-lg text-lg" required>
                                <option value="" disabled selected>Sélectionnez un candidat</option>
                                <?php foreach($candidats as $candidat): ?>
                                    <option value="<?= $candidat['id'] ?>" class="candidate-option"><?= htmlspecialchars($candidat['Nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Date et heure -->
                        <div class="form-control">
                        <label for="date_heure_debut" class="label">
                        <span class="label-text font-semibold text-lg">
                        <i class="bi bi-clock mr-2 calendar-icon"></i>Date et heure de début :
                        </span>
                        </label>
                        <input type="datetime-local"
                        name="date_heure_debut"
                        id="date_heure_debut"
                        class="input input-bordered w-full form-input p-3 rounded-lg text-lg"
                        required>
                        </div>

                        <!-- Durée de l'entretien -->
                        <div class="form-control">
                            <label for="duree" class="label">
                                <span class="label-text font-semibold text-lg">
                                    <i class="bi bi-hourglass-split mr-2 calendar-icon"></i>Durée estimée :
                                </span>
                            </label>
                            <select name="duree" id="duree" class="select select-bordered w-full form-input p-3 rounded-lg text-lg">
                                <option value="30">30 minutes</option>
                                <option value="45" selected>45 minutes</option>
                                <option value="60">1 heure</option>
                                <option value="90">1 heure 30</option>
                            </select>
                        </div>
                        
                        <!-- Type d'entretien -->
                        <div class="form-control">
                            <label for="type_entretien" class="label">
                                <span class="label-text font-semibold text-lg">
                                    <i class="bi bi-laptop mr-2 calendar-icon"></i>Type d'entretien :
                                </span>
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="type_entretien" value="presentiel" class="radio radio-primary mr-2" checked />
                                    <span>Présentiel</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="type_entretien" value="visio" class="radio radio-primary mr-2" />
                                    <span>Visio</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Bouton de soumission -->
                        <div class="form-control mt-10">
                            <button type="submit" class="btn btn-primary text-white text-lg py-4 rounded-lg btn-block">
                                <i class="bi bi-calendar-plus mr-2"></i>Planifier l'entretien
                            </button>
                        </div>
                    </form>
                    
                    <!-- Message de succès (caché par défaut) -->
                    <div id="successMessage" class="success-message">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-3xl mr-3"></i>
                            <div>
                                <h3 class="font-bold text-lg">Entretien planifié avec succès !</h3>
                                <p class="mt-1">Un email de confirmation a été envoyé au candidat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section informations supplémentaires -->
            <div class="mt-20">
                <h2 class="text-3xl font-bold text-center mb-12" style="color: var(--color-dark);">Pourquoi choisir VertDesign ?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-body items-center text-center">
                            <i class="bi bi-award feature-icon"></i>
                            <h3 class="card-title">Expertise reconnue</h3>
                            <p>Plus de 15 ans d'expérience dans la création d'espaces verts exceptionnels.</p>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-body items-center text-center">
                            <i class="bi bi-people feature-icon"></i>
                            <h3 class="card-title">Équipe passionnée</h3>
                            <p>Des paysagistes talentueux dévoués à la réalisation de vos projets.</p>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-body items-center text-center">
                            <i class="bi bi-tree feature-icon"></i>
                            <h3 class="card-title">Engagement écologique</h3>
                            <p>Nous privilégions les pratiques durables et respectueuses de l'environnement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer p-10 bg-base-200 text-base-content">
        <div>
            <i class="bi bi-tree-fill text-3xl" style="color: var(--color-dark);"></i>
            <p class="font-bold text-lg" style="color: var(--color-dark);">VertDesign<br/>Créateurs d'espaces verts depuis 2008</p>
        </div> 
        <div>
            <span class="footer-title">Services</span> 
            <a class="link link-hover">Aménagement paysager</a> 
            <a class="link link-hover">Entretien de jardins</a> 
            <a class="link link-hover">Éclairage extérieur</a> 
            <a class="link link-hover">Systèmes d'arrosage</a>
        </div> 
        <div>
            <span class="footer-title">Entreprise</span> 
            <a class="link link-hover">À propos</a> 
            <a class="link link-hover">Contact</a> 
            <a class="link link-hover">Recrutement</a> 
            <a class="link link-hover">Presse</a>
        </div> 
        <div>
            <span class="footer-title">Légal</span> 
            <a class="link link-hover">Conditions d'utilisation</a> 
            <a class="link link-hover">Politique de confidentialité</a> 
            <a class="link link-hover">Politique de cookies</a>
        </div>
    </footer>
    <footer class="footer px-10 py-4 border-t bg-base-200 text-base-content border-base-300">
        <div class="items-center grid-flow-col">
            <p>© 2023 VertDesign. Tous droits réservés.</p>
        </div> 
        <div class="md:place-self-end md:justify-self-end">
            <div class="grid grid-flow-col gap-4">
                <a><i class="bi bi-twitter text-xl" style="color: var(--color-dark);"></i></a> 
                <a><i class="bi bi-facebook text-xl" style="color: var(--color-dark);"></i></a> 
                <a><i class="bi bi-instagram text-xl" style="color: var(--color-dark);"></i></a>
            </div>
        </div>
    </footer>

<!--    <script>
        // Script pour gérer l'affichage du message de succès
        document.getElementById('entretienForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Simulation d'envoi réussi
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';

            // Réinitialiser le formulaire après 5 secondes
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        });

        // Amélioration de l'expérience utilisateur pour la sélection de date
        const dateInput = document.getElementById('date_heure_debut');
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        dateInput.min = now.toISOString().slice(0, 16);

        // Pré-remplir avec une date par défaut (demain à 10h)
        const tomorrow = new Date(now);
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(10, 0, 0, 0);
        dateInput.value = tomorrow.toISOString().slice(0, 16);

        // Animation des cartes au défilement
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Appliquer l'animation aux cartes
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>-->
</body>
</html>
