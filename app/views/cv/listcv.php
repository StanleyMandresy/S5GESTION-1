<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes CVs - Flight</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Daisy UI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D726F',
                        secondary: '#859393',
                        accent: '#B4BAB1',
                        light: '#CED0C3',
                        lighter: '#DCDED6'
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background: linear-gradient(to bottom, #DCDED6, #CED0C3);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header-content {
            background: linear-gradient(135deg, #5D726F 0%, #859393 100%);
            border-bottom: 3px solid #B4BAB1;
        }
        
        .cv-card {
            transition: all 0.3s ease;
            background: linear-gradient(to bottom, #ffffff, #F8F9FA);
            border-left: 4px solid #5D726F;
            overflow: hidden;
            position: relative;
        }
        
        .cv-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #5D726F, #859393, #B4BAB1);
        }
        
        .cv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(93, 114, 111, 0.2);
        }
        
        .skill-tag {
            background: linear-gradient(to right, #B4BAB1, #859393);
            color: white;
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #5D726F 0%, #859393 100%);
        }
        
        .search-box input:focus {
            border-color: #5D726F;
            box-shadow: 0 0 0 0.25rem rgba(93, 114, 111, 0.25);
        }
        
        .btn-view {
            background: linear-gradient(to right, #5D726F, #859393);
            color: white;
            transition: all 0.3s;
        }
        
        .btn-view:hover {
            background: linear-gradient(to right, #859393, #5D726F);
            transform: scale(1.05);
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }
        
        .cv-detail-label {
            color: #5D726F;
            font-weight: 500;
        }
        
        .filter-btn, .sort-btn {
            transition: all 0.3s;
        }
        
        .filter-btn:hover, .sort-btn:hover {
            background-color: #5D726F;
            color: white;
        }
        
        /* Animation pour les cartes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .cv-card {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Filtres panel */
        .filters-panel {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(93, 114, 111, 0.2);
            padding: 20px;
            margin-bottom: 20px;
            display: none;
        }
        
        .filters-panel.active {
            display: block;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #5D726F;
        }
        
        .filter-group input, .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #CED0C3;
            border-radius: 6px;
        }
        
        .filter-group input:focus, .filter-group select:focus {
            outline: none;
            border-color: #5D726F;
        }
        
        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }
        
        /* Badge de filtres actifs */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .filter-badge {
            background: linear-gradient(to right, #5D726F, #859393);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }
        
        .filter-badge .close {
            margin-left: 5px;
            cursor: pointer;
        }
        
        /* Options de tri */
        .sort-options {
            position: absolute;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 10px 0;
            z-index: 10;
            display: none;
            width: 200px;
            right: 0;
            top: 100%;
            margin-top: 5px;
        }
        
        .sort-options.active {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }
        
        .sort-option {
            padding: 8px 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .sort-option:hover {
            background-color: #f5f5f5;
        }
        
        .sort-option.active {
            background-color: #e9ecef;
            color: #5D726F;
            font-weight: 500;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                padding: 1rem;
            }
            
            .user-info {
                margin-top: 1rem;
            }
            
            .controls {
                flex-direction: column;
            }
            
            .search-box {
                width: 100%;
                margin-bottom: 1rem;
            }
            
            .filter-sort {
                width: 100%;
                justify-content: center;
            }
            
            .sort-options {
                right: auto;
                left: 0;
                width: 100%;
            }
        }
        
        /* Loading animation */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }
        
        .spinner {
            border: 4px solid rgba(93, 114, 111, 0.3);
            border-radius: 50%;
            border-top: 4px solid #5D726F;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            display: none;
        }
    </style>
</head>
<body>
<?php if (!empty($_SESSION['success_message'])): ?>
<div class="alert alert-success">
<?= htmlspecialchars($_SESSION['success_message']) ?>
</div>
<?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
    <?php include __DIR__ . '/header.php'; ?>
    <!-- Élément de décoration feuille -->
    <div class="leaf-decoration" style="top: 10%; right: 5%; transform: rotate(25deg);">
        <i class="fas fa-leaf" style="font-size: 8rem; color: #5D726F;"></i>
    </div>
    
    <div class="leaf-decoration" style="bottom: 10%; left: 5%; transform: rotate(-15deg);">
        <i class="fas fa-leaf" style="font-size: 10rem; color: #859393;"></i>
    </div>

    <div class="container mx-auto px-4 mb-12">
        <div class="controls flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow-md">
            <div class="search-box relative flex-grow max-w-md">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                <input type="text" id="search-input" placeholder="Rechercher un CV..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <div class="flex items-center max-w-md">
            <a href="/offers/result"
            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition text-center">
            Voir les scores
            </a>
            </div>

            <div class="filter-sort flex space-x-4 relative">
                <button id="filter-btn" class="filter-btn border border-primary text-primary px-4 py-2 rounded-full flex items-center">
                    <i class="fas fa-filter mr-2"></i> Filtres
                </button>
                <div class="relative">
                    <button id="sort-btn" class="sort-btn border border-primary text-primary px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-sort mr-2"></i> Trier
                    </button>
                    <div id="sort-options" class="sort-options">
                        <div class="sort-option" data-sort="name-asc">Nom (A-Z)</div>
                        <div class="sort-option" data-sort="name-desc">Nom (Z-A)</div>
                        <div class="sort-option" data-sort="experience-asc">Expérience (Croissant)</div>
                        <div class="sort-option" data-sort="experience-desc">Expérience (Décroissant)</div>
                        <div class="sort-option" data-sort="salary-asc">Salaire (Croissant)</div>
                        <div class="sort-option" data-sort="salary-desc">Salaire (Décroissant)</div>
                        <div class="sort-option" data-sort="date-asc">Date (Plus ancien)</div>
                        <div class="sort-option" data-sort="date-desc">Date (Plus récent)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de filtres -->
        <div id="filters-panel" class="filters-panel">
            <h3 class="text-lg font-semibold mb-4 text-primary">Filtres avancés</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="filter-group">
                    <label for="filter-experience">Années d'expérience min</label>
                    <input type="number" id="filter-experience" min="0" placeholder="0">
                </div>
                
                <div class="filter-group">
                    <label for="filter-salary">Salaire souhaité max (€)</label>
                    <input type="number" id="filter-salary" min="0" placeholder="50000">
                </div>
                
                <div class="filter-group">
                    <label for="filter-diploma">Diplôme</label>
                    <select id="filter-diploma">
                        <option value="">Tous les diplômes</option>
                        <option value="Bac">Bac</option>
                        <option value="Bac+2">Bac+2</option>
                        <option value="Bac+3">Bac+3</option>
                        <option value="Bac+5">Bac+5</option>
                        <option value="Doctorat">Doctorat</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-skills">Compétences</label>
                    <input type="text" id="filter-skills" placeholder="JavaScript, PHP, Python...">
                </div>
            </div>
            
            <div class="filter-actions">
                <button id="reset-filters" class="px-4 py-2 border border-gray-300 rounded-full text-gray-600">
                    Réinitialiser
                </button>
                <button id="apply-filters" class="px-4 py-2 bg-primary text-white rounded-full ml-2">
                    Appliquer les filtres
                </button>
            </div>
            
            <div id="active-filters" class="active-filters"></div>
        </div>

        <!-- Indicateur de chargement -->
        <div id="loading-spinner" class="loading-spinner">
            <div class="spinner"></div>
            <p class="mt-2 text-primary">Chargement...</p>
        </div>

        <!-- Message aucun résultat -->
        <div id="no-results" class="no-results">
            <i class="fas fa-search fa-3x text-secondary mb-4"></i>
            <h3 class="text-xl font-semibold text-primary">Aucun résultat trouvé</h3>
            <p class="text-secondary mt-2">Essayez de modifier vos critères de recherche ou de filtrage.</p>
        </div>

        <!-- Liste des CVs -->
        <div id="cv-list" class="cv-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($cvs)): ?>
            <?php foreach ($cvs as $cv): ?>
            <div class="cv-card rounded-lg shadow-md p-6" data-cv='<?= json_encode([
                'name' => htmlspecialchars(($cv['Nom'] ?? '') . ' ' . ($cv['Prenom'] ?? '')),
                'title' => htmlspecialchars($cv['diploma_name'] ?? 'N/A'),
                'email' => htmlspecialchars($cv['Mail'] ?? ''),
                'phone' => htmlspecialchars($cv['phone'] ?? ''),
                'address' => htmlspecialchars($cv['address'] ?? ''),
                'experience' => intval($cv['experience_year'] ?? 0),
                'salary' => intval($cv['salaire_souhaite'] ?? 0),
                'skills' => array_map('trim', explode(',', $cv['languages'] ?? '')),
                'date' => htmlspecialchars($cv['date_depot'] ?? ''),
                'diploma' => htmlspecialchars($cv['diploma_name'] ?? '')
            ]) ?>'>
                <div class="cv-header mb-4">
                    <div class="cv-actions flex justify-end mb-2">
                        <a href="#" class="text-secondary hover:text-primary">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                    <h2 class="cv-name text-2xl font-bold text-primary mb-1"><?= htmlspecialchars($cv['Nom'] ?? '' . ' ' . $cv['Prenom'] ?? '') ?></h2>
                    <p class="cv-title text-secondary mb-4"><?= htmlspecialchars($cv['diploma_name'] ?? 'N/A') ?></p>

                    <div class="cv-detail flex items-center mb-2">
                        <span class="cv-detail-label w-8 mr-2"><i class="fas fa-envelope"></i></span>
                        <span class="text-sm truncate"><?= htmlspecialchars($cv['Mail'] ?? '') ?></span>
                    </div>

                    <div class="cv-detail flex items-center mb-2">
                        <span class="cv-detail-label w-8 mr-2"><i class="fas fa-phone"></i></span>
                        <span><?= htmlspecialchars($cv['phone'] ?? '') ?></span>
                    </div>

                    <div class="cv-detail flex items-center mb-2">
                        <span class="cv-detail-label w-8 mr-2"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="text-sm"><?= htmlspecialchars($cv['address'] ?? '') ?></span>
                    </div>



                    <div class="cv-detail flex items-center mb-2">
                        <span class="cv-detail-label w-8 mr-2"><i class="fas fa-chart-line"></i></span>
                        <span><?= htmlspecialchars($cv['experience_year'] ?? '') ?> ans d'expérience</span>
                    </div>

                    <div class="cv-detail flex items-center mb-4">
                        <span class="cv-detail-label w-8 mr-2"><i class="fas fa-euro-sign"></i></span>
                        <span class="font-semibold"><?= htmlspecialchars($cv['salaire_souhaite'] ?? '') ?> €</span>
                    </div>

                    <div class="cv-detail mb-4">
                        <div class="cv-detail-label mb-2"><i class="fas fa-star mr-2"></i> Compétences:</div>
                        <div class="cv-skills flex flex-wrap gap-2">
                            <?php foreach (explode(',', $cv['languages'] ?? '') as $lang): ?>
                            <?php if (trim($lang) !== ''): ?>
                            <span class="skill-tag text-xs px-3 py-1 rounded-full"><i class="fas fa-check mr-1"></i> <?= htmlspecialchars(trim($lang)) ?></span>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="cv-footer flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="cv-date text-sm text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Déposé le: <?= htmlspecialchars($cv['date_depot'] ?? '') ?>
                        </span>
                        <a href="/cv/view?id=<?= htmlspecialchars($cv['cv_id'] ?? 0) ?>" class="btn-view px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-eye mr-2"></i> Voir
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-span-full text-center py-12">
                <i class="fas fa-file-alt text-5xl text-secondary mb-4 opacity-50"></i>
                <p class="text-xl text-primary font-semibold">Aucun CV trouvé pour cette offre.</p>
                <p class="text-secondary mt-2">Les CVs apparaîtront ici une fois que les candidats auront postulé.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="text-end mb-3">
    <form action="/cv/trier" method="POST">
    <input type="hidden" name="job_offer_id" value="<?= htmlspecialchars($job_offer_id) ?>">
    <button type="submit" class="btn btn-primary">
    <i class="fas fa-sort-amount-down"></i> Trier les CVs
    </button>
    </form>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments DOM
            const searchInput = document.getElementById('search-input');
            const filterBtn = document.getElementById('filter-btn');
            const sortBtn = document.getElementById('sort-btn');
            const filtersPanel = document.getElementById('filters-panel');
            const sortOptions = document.getElementById('sort-options');
            const applyFiltersBtn = document.getElementById('apply-filters');
            const resetFiltersBtn = document.getElementById('reset-filters');
            const cvList = document.getElementById('cv-list');
            const cvCards = document.querySelectorAll('.cv-card');
            const loadingSpinner = document.getElementById('loading-spinner');
            const noResults = document.getElementById('no-results');
            const activeFiltersContainer = document.getElementById('active-filters');
            
            // Variables d'état
            let currentFilters = {
                search: '',
                experience: '',
                salary: '',
                diploma: '',
                skills: ''
            };
            
            let currentSort = 'name-asc';
            
            // Configuration des écouteurs d'événements
            searchInput.addEventListener('input', debounce(function() {
                currentFilters.search = this.value.toLowerCase();
                filterCVs();
            }, 300));
            
            filterBtn.addEventListener('click', function() {
                filtersPanel.classList.toggle('active');
                sortOptions.classList.remove('active');
            });
            
            sortBtn.addEventListener('click', function() {
                sortOptions.classList.toggle('active');
                filtersPanel.classList.remove('active');
            });
            
            // Appliquer les filtres
            applyFiltersBtn.addEventListener('click', function() {
                currentFilters.experience = document.getElementById('filter-experience').value;
                currentFilters.salary = document.getElementById('filter-salary').value;
                currentFilters.diploma = document.getElementById('filter-diploma').value;
                currentFilters.skills = document.getElementById('filter-skills').value.toLowerCase();
                
                updateActiveFilters();
                filterCVs();
                filtersPanel.classList.remove('active');
            });
            
            // Réinitialiser les filtres
            resetFiltersBtn.addEventListener('click', function() {
                document.getElementById('filter-experience').value = '';
                document.getElementById('filter-salary').value = '';
                document.getElementById('filter-diploma').value = '';
                document.getElementById('filter-skills').value = '';
                
                currentFilters = {
                    search: searchInput.value.toLowerCase(),
                    experience: '',
                    salary: '',
                    diploma: '',
                    skills: ''
                };
                
                activeFiltersContainer.innerHTML = '';
                filterCVs();
            });
            
            // Options de tri
            document.querySelectorAll('.sort-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.sort-option').forEach(opt => {
                        opt.classList.remove('active');
                    });
                    this.classList.add('active');
                    currentSort = this.getAttribute('data-sort');
                    sortOptions.classList.remove('active');
                    filterCVs();
                });
            });
            
            // Fermer le panneau de tri en cliquant ailleurs
            document.addEventListener('click', function(e) {
                if (!sortBtn.contains(e.target) && !sortOptions.contains(e.target)) {
                    sortOptions.classList.remove('active');
                }
                if (!filterBtn.contains(e.target) && !filtersPanel.contains(e.target)) {
                    filtersPanel.classList.remove('active');
                }
            });
            
            // Fonction de filtrage
            function filterCVs() {
                loadingSpinner.style.display = 'block';
                cvList.style.opacity = '0.5';
                
                setTimeout(() => {
                    let visibleCount = 0;
                    
                    cvCards.forEach(card => {
                        const cvData = JSON.parse(card.getAttribute('data-cv'));
                        let isVisible = true;
                        
                        // Filtre de recherche
                        if (currentFilters.search) {
                            const searchableText = `
                                ${cvData.name} 
                                ${cvData.title} 
                                ${cvData.email} 
                                ${cvData.phone} 
                                ${cvData.address} 
                                ${cvData.skills.join(' ')}
                            `.toLowerCase();
                            
                            if (!searchableText.includes(currentFilters.search)) {
                                isVisible = false;
                            }
                        }
                        
                        // Filtre d'expérience
                        if (isVisible && currentFilters.experience) {
                            if (cvData.experience < parseInt(currentFilters.experience)) {
                                isVisible = false;
                            }
                        }
                        
                        // Filtre de salaire
                        if (isVisible && currentFilters.salary) {
                            if (cvData.salary > parseInt(currentFilters.salary)) {
                                isVisible = false;
                            }
                        }
                        
                        // Filtre de diplôme
                        if (isVisible && currentFilters.diploma) {
                            if (!cvData.diploma.includes(currentFilters.diploma)) {
                                isVisible = false;
                            }
                        }
                        
                        // Filtre de compétences
                        if (isVisible && currentFilters.skills) {
                            const requiredSkills = currentFilters.skills.split(',').map(skill => skill.trim());
                            const hasAllSkills = requiredSkills.every(skill => 
                                cvData.skills.some(cvSkill => 
                                    cvSkill.toLowerCase().includes(skill)
                                )
                            );
                            
                            if (!hasAllSkills) {
                                isVisible = false;
                            }
                        }
                        
                        // Appliquer la visibilité
                        if (isVisible) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    
                    // Trier les CVs visibles
                    sortVisibleCVs(visibleCount);
                    
                    // Afficher/masquer le message aucun résultat
                    if (visibleCount === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                    
                    loadingSpinner.style.display = 'none';
                    cvList.style.opacity = '1';
                }, 500);
            }
            
            // Fonction de tri
            function sortVisibleCVs(visibleCount) {
                const visibleCards = Array.from(cvCards).filter(card => card.style.display !== 'none');
                
                visibleCards.sort((a, b) => {
                    const dataA = JSON.parse(a.getAttribute('data-cv'));
                    const dataB = JSON.parse(b.getAttribute('data-cv'));
                    
                    switch (currentSort) {
                        case 'name-asc':
                            return dataA.name.localeCompare(dataB.name);
                        case 'name-desc':
                            return dataB.name.localeCompare(dataA.name);
                        case 'experience-asc':
                            return dataA.experience - dataB.experience;
                        case 'experience-desc':
                            return dataB.experience - dataA.experience;
                        case 'salary-asc':
                            return dataA.salary - dataB.salary;
                        case 'salary-desc':
                            return dataB.salary - dataA.salary;
                        case 'date-asc':
                            return new Date(dataA.date) - new Date(dataB.date);
                        case 'date-desc':
                            return new Date(dataB.date) - new Date(dataA.date);
                        default:
                            return 0;
                    }
                });
                
                // Réorganiser les cartes dans le DOM
                visibleCards.forEach(card => {
                    cvList.appendChild(card);
                });
            }
            
            // Mettre à jour les badges de filtres actifs
            function updateActiveFilters() {
                activeFiltersContainer.innerHTML = '';
                
                if (currentFilters.experience) {
                    addFilterBadge(`Expérience: ${currentFilters.experience}+ ans`, 'experience');
                }
                
                if (currentFilters.salary) {
                    addFilterBadge(`Salaire: ≤ ${currentFilters.salary}€`, 'salary');
                }
                
                if (currentFilters.diploma) {
                    const diplomaText = document.getElementById('filter-diploma').options[document.getElementById('filter-diploma').selectedIndex].text;
                    addFilterBadge(`Diplôme: ${diplomaText}`, 'diploma');
                }
                
                if (currentFilters.skills) {
                    addFilterBadge(`Compétences: ${currentFilters.skills}`, 'skills');
                }
            }
            
            // Ajouter un badge de filtre actif
            function addFilterBadge(text, type) {
                const badge = document.createElement('div');
                badge.className = 'filter-badge';
                badge.innerHTML = `
                    ${text}
                    <span class="close" data-type="${type}">&times;</span>
                `;
                activeFiltersContainer.appendChild(badge);
                
                // Supprimer le filtre en cliquant sur la croix
                badge.querySelector('.close').addEventListener('click', function() {
                    const filterType = this.getAttribute('data-type');
                    document.getElementById(`filter-${filterType}`).value = '';
                    currentFilters[filterType] = '';
                    badge.remove();
                    filterCVs();
                });
            }
            
            // Fonction debounce pour optimiser les recherches
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this, args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }
            
            // Animation pour les boutons de filtre et tri
            [filterBtn, sortBtn].forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
