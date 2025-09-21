<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon CV - Entreprise de Paysagiste</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DaisyUI via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            color: var(--color-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .landscape-bg {
            background: linear-gradient(rgba(93, 114, 111, 0.8), rgba(133, 147, 147, 0.8)), 
                        url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%23B4BAB1" width="100" height="100"/><path d="M0,50 Q20,30 50,50 T100,50 L100,100 L0,100 Z" fill="%235D726F"/><circle cx="20" cy="30" r="5" fill="%23DCDED6"/><circle cx="80" cy="40" r="7" fill="%23DCDED6"/></svg>');
            background-size: cover;
            background-position: center;
        }
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(93, 114, 111, 0.2);
        }
        
        .form-control, .form-select {
            border: 1px solid var(--color-medium);
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--color-dark);
            box-shadow: 0 0 0 0.25rem rgba(93, 114, 111, 0.25);
        }
        
        .btn-primary {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--color-dark-medium);
            border-color: var(--color-dark-medium);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(93, 114, 111, 0.3);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: var(--color-dark);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--color-dark);
        }
        
        .floating-label {
            position: relative;
            margin-bottom: 20px;
        }
        
        .floating-label label {
            position: absolute;
            top: 12px;
            left: 15px;
            transition: all 0.3s;
            pointer-events: none;
            color: var(--color-dark-medium);
            background-color: white;
            padding: 0 5px;
        }
        
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label,
        .floating-label select:focus + label,
        .floating-label select:not([value=""]):valid + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: var(--color-dark);
        }
        
        .progress-bar {
            height: 5px;
            background-color: var(--color-dark);
            width: 0%;
            transition: width 0.5s;
            border-radius: 10px;
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 10%;
            left: 5%;
            transform: rotate(30deg);
            font-size: 100px;
            color: var(--color-dark);
        }
        
        .leaf-2 {
            bottom: 10%;
            right: 5%;
            transform: rotate(-20deg);
            font-size: 120px;
            color: var(--color-dark);
        }
    </style>
</head>
<body class="min-h-screen py-5 landscape-bg">
    <div class="leaf-decoration leaf-1">
        <i class="fas fa-leaf"></i>
    </div>
    <div class="leaf-decoration leaf-2">
        <i class="fas fa-leaf"></i>
    </div>
    
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- En-tête -->
            <header class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-3 text-white">
                    <i class="fas fa-leaf me-3"></i>Créer mon CV
                </h1>
                <p class="text-xl text-white">Postulez pour rejoindre notre équipe de paysagistes passionnés</p>
                
                <!-- Barre de progression -->
                <div class="w-full bg-white rounded-full mt-5 mx-auto" style="max-width: 500px; height: 8px;">
                    <div class="progress-bar rounded-full" id="progress-bar"></div>
                </div>
            </header>
            
            <!-- Formulaire -->
            <div class="form-container p-6 md:p-8 relative">
                <form method="POST" action="/cv/submit" id="cv-form">
                    <?php if (isset($_POST['job_offer_id'])): ?>
                    <input type="hidden" name="job_offer_id" value="<?= htmlspecialchars($_POST['job_offer_id']) ?>">
                    <?php endif; ?>
                    
                    <div class="mb-6">
                        <h3 class="section-title text-2xl font-semibold">
                            <i class="fas fa-graduation-cap me-2"></i>Formation
                        </h3>
                        
                        <div class="floating-label">
                            <select name="diploma_id" class="form-select w-full" required>
                                <option value="" selected disabled></option>
                                <?php foreach ($diplomas as $diploma): ?>
                                <option value="<?= $diploma['id'] ?>"><?= htmlspecialchars($diploma['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="diploma_id">Diplôme</label>
                        </div>
                        
                        <div class="floating-label">
                            <select name="level" class="form-select w-full" required>
                                <option value="" selected disabled></option>
                                <option value="1">Bac +1</option>
                                <option value="2">Bac +2</option>
                                <option value="3">Bac +3 Licence</option>
                                <option value="4">Bac +4 / Master 1</option>
                                <option value="5">Bac +5 / Master 2</option>
                            </select>
                            <label for="level">Niveau d'étude</label>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="section-title text-2xl font-semibold">
                            <i class="fas fa-briefcase me-2"></i>Expérience
                        </h3>
                        
                        <div class="floating-label">
                            <input type="number" name="experience_year" min="0" class="form-control w-full" placeholder=" ">
                            <label for="experience_year">Années d'expérience</label>
                        </div>
                        
                        <div class="floating-label">
                            <textarea name="atout" class="form-control w-full" placeholder="Atout " rows="3"></textarea>
                            <label for="atout" ></label>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="section-title text-2xl font-semibold">
                            <i class="fas fa-globe me-2"></i>Compétences linguistiques
                        </h3>
                        
                        <div class="floating-label">
                            <input type="text" name="languages" class="form-control w-full" placeholder=" ">
                            <label for="languages">Langues (séparées par des virgules)</label>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="section-title text-2xl font-semibold">
                            <i class="fas fa-euro-sign me-2"></i>Rémunération
                        </h3>
                        
                        <div class="floating-label">
                            <input type="number" step="0.01" name="salaire_souhaite" class="form-control w-full" placeholder=" ">
                            <label for="salaire_souhaite">Salaire souhaité (€)</label>
                        </div>
                        
                        <div class="floating-label">
                            <textarea name="avantages" class="form-control w-full" placeholder="Avantages souhaités " rows="3"></textarea>
                            <label for="avantages"></label>
                        </div>
                    </div>
                    
                    <div class="text-center mt-8">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer ma candidature
                        </button>
                    </div>
                </form>
            </div>
            
            <footer class="text-center mt-6 text-white">
                <p>© 2023 Entreprise de Paysagiste - Tous droits réservés</p>
            </footer>
        </div>
    </div>

    <!-- JavaScript pour les effets interactifs -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cv-form');
            const progressBar = document.getElementById('progress-bar');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            // Animation de la barre de progression
            function updateProgressBar() {
                let filledCount = 0;
                inputs.forEach(input => {
                    if (input.value) filledCount++;
                });
                
                const progress = (filledCount / inputs.length) * 100;
                progressBar.style.width = `${progress}%`;
            }
            
            // Écouter les changements sur tous les champs
            inputs.forEach(input => {
                input.addEventListener('input', updateProgressBar);
                input.addEventListener('change', updateProgressBar);
            });
            
            // Initialiser la barre de progression
            updateProgressBar();
            
            // Effet de focus amélioré
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-offset-2', 'ring-opacity-50', 'ring-[#5D726F]');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-offset-2', 'ring-opacity-50', 'ring-[#5D726F]');
                });
            });
        });
    </script>
</body>
</html>