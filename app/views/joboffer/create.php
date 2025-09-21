<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Offre d'Emploi | Entreprise Paysagiste</title>
    <!-- Tailwind CSS avec Daisy UI -->
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
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23859393' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.15;
            z-index: 0;
        }
        
        .form-container {
            position: relative;
            z-index: 1;
        }
        
        .floating-label {
            transition: all 0.3s ease;
        }
        
        input:focus + .floating-label,
        textarea:focus + .floating-label,
        select:focus + .floating-label,
        input:not(:placeholder-shown) + .floating-label,
        textarea:not(:placeholder-shown) + .floating-label,
        select:not([value=""]):valid + .floating-label {
            top: -12px;
            left: 10px;
            font-size: 0.75rem;
            background: white;
            padding: 0 5px;
            color: var(--color-darker);
        }
    </style>
</head>
<body class="min-h-screen py-8 px-4">
    <!-- Décorations feuilles -->
    <div class="leaf-decoration top-20 left-10 transform rotate-45 text-8xl text-[#5D726F]">
        <i class="bi bi-flower1"></i>
    </div>
    <div class="leaf-decoration top-1/3 right-5 transform -rotate-12 text-6xl text-[#859393]">
        <i class="bi bi-tree"></i>
    </div>
    <div class="leaf-decoration bottom-40 left-20 transform rotate-25 text-9xl text-[#B4BAB1]">
        <i class="bi bi-flower2"></i>
    </div>
    
    <div class="container mx-auto max-w-3xl form-container">
        <!-- En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#5D726F] mb-2">
                <i class="bi bi-flower3 mr-3"></i>
                Créer une Offre d'Emploi
            </h1>
            <p class="text-[#859393]">Rejoignez notre équipe de paysagistes passionnés</p>
        </div>
        
        <!-- Formulaire -->
        <div class="card shadow-2xl bg-white rounded-2xl overflow-hidden">
            <div class="card-body py-8 px-6 md:px-10">
                <form method="POST" action="/offers/create" id="offerForm" class="space-y-6">
                    <!-- Titre -->
                    <div class="form-control relative">
                        <input type="text" name="title" class="input input-bordered pt-5 pb-3 px-4 w-full" placeholder=" " required>
                        <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                            <i class="bi bi-pencil-square mr-2"></i>Titre du poste
                        </label>
                    </div>
                    
                    <!-- Description -->
                    <div class="form-control relative">
                        <textarea name="description" class="textarea textarea-bordered pt-5 pb-3 px-4 w-full h-32" placeholder=" " required></textarea>
                        <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                            <i class="bi bi-text-paragraph mr-2"></i>Description détaillée
                        </label>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Département -->
                        <div class="form-control relative">
                            <select name="department_id" class="select select-bordered pt-3 pb-3 px-4 w-full" required>
                                <option value="" selected disabled></option>
                                <?php foreach ($departments as $dept): ?>
                                <option value="<?= htmlspecialchars($dept['id']) ?>">
                                    <?= htmlspecialchars($dept['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-building mr-2"></i>Département
                            </label>
                        </div>
                        
                        <!-- Lieu -->
                        <div class="form-control relative">
                            <input type="text" name="locations" class="input input-bordered pt-5 pb-3 px-4 w-full" placeholder=" " required>
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-geo-alt mr-2"></i>Lieu de travail
                            </label>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date limite -->
                        <div class="form-control relative">
                            <input type="date" name="deadline" class="input input-bordered pt-5 pb-3 px-4 w-full" placeholder=" " required>
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-calendar-event mr-2"></i>Date limite
                            </label>
                        </div>
                        
                        <!-- Diplôme -->
                        <div class="form-control relative">
                            <select name="diploma_id" class="select select-bordered pt-1 pb-3 px-4 w-full" required>
                                <option value="" selected disabled></option>
                                <?php foreach ($diplomas as $diploma): ?>
                                <option value="<?= htmlspecialchars($diploma['id']) ?>">
                                    <?= htmlspecialchars($diploma['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-mortarboard mr-2"></i>Diplôme requis
                            </label>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Niveau -->
                        <div class="form-control relative">
                            <select name="level" class="select select-bordered pt-1 pb-3 px-4 w-full" required>
                                <option value="" selected disabled></option>
                                <option value="1">Bac +1</option>
                                <option value="3">Bac +3 Licence</option>
                                <option value="4">Bac +4 Master 1</option>
                                <option value="5">Bac +5 Master 2</option>
                            </select>
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-bar-chart mr-2"></i>Niveau d'études
                            </label>
                        </div>
                        
                        <!-- Expérience -->
                        <div class="form-control relative">
                            <input type="number" name="experience_year" min="0" class="input input-bordered pt-5 pb-3 px-4 w-full" placeholder=" ">
                            <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                                <i class="bi bi-clock-history mr-2"></i>Expérience (années)
                            </label>
                        </div>
                    </div>
                    
                    <!-- Avantages -->
                    <div class="form-control relative">
                        <textarea name="benefits" class="textarea textarea-bordered pt-5 pb-3 px-4 w-full h-24" placeholder=" "></textarea>
                        <label class="floating-label absolute left-4 top-4 text-[#859393] pointer-events-none">
                            <i class="bi bi-gift mr-2"></i>Avantages (un par ligne)
                        </label>
                    </div>
                    
                    <input type="hidden" name="is_active" value="1">
                    
                    <!-- Bouton de soumission -->
                    <div class="form-control mt-10">
                        <button type="submit" class="btn btn-block text-white border-0 bg-[#5D726F] hover:bg-[#859393] transition-colors duration-300 py-3 text-lg">
                            <i class="bi bi-check-circle mr-2"></i>
                            Publier l'offre
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Notification de succès (cachée par défaut) -->
        <div id="successNotification" class="toast toast-top toast-center hidden">
            <div class="alert alert-success bg-[#5D726F] text-white">
                <span><i class="bi bi-check-circle-fill mr-2"></i> Offre créée avec succès !</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments au chargement
            const formElements = document.querySelectorAll('.form-control');
            formElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('opacity-100', 'translate-y-0');
                }, 100 + (index * 100));
            });
            
            // Gestion de la soumission du formulaire
            const form = document.getElementById('offerForm');
            const successNotification = document.getElementById('successNotification');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simulation d'envoi réussi
                successNotification.classList.remove('hidden');
                
                // Masquer la notification après 3 secondes
                setTimeout(() => {
                    successNotification.classList.add('hidden');
                    // En production, vous enlèverez cette ligne et laisserez le formulaire se soumettre normalement
                    form.submit();
                }, 3000);
            });
            
            // Effet de survol pour les décorations
            const decorations = document.querySelectorAll('.leaf-decoration');
            decorations.forEach(decoration => {
                decoration.addEventListener('mouseover', () => {
                    decoration.classList.add('scale-110', 'transition-transform', 'duration-500');
                });
                
                decoration.addEventListener('mouseout', () => {
                    decoration.classList.remove('scale-110');
                });
            });
        });
    </script>
</body>
</html>