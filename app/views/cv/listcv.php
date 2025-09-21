<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes CVs - Flight</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --light-color: #f3f4f6;
            --dark-color: #1f2937;
            --text-color: #374151;
            --border-color: #d1d5db;
            --success-color: #10b981;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
            padding-bottom: 40px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        header h1 {
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        header h1 i {
            font-size: 2rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 8px 20px;
            box-shadow: var(--card-shadow);
            width: 100%;
            max-width: 400px;
        }
        
        .search-box input {
            border: none;
            outline: none;
            padding: 8px 15px;
            width: 100%;
            font-size: 1rem;
            color: var(--text-color);
        }
        
        .search-box i {
            color: var(--primary-color);
        }
        
        .filter-sort {
            display: flex;
            gap: 15px;
        }
        
        .filter-btn, .sort-btn {
            background: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: var(--card-shadow);
            color: var(--text-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover, .sort-btn:hover {
            background: var(--light-color);
        }
        
        .add-cv-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: var(--card-shadow);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .add-cv-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .cv-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .cv-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .cv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        
        .cv-header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .cv-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 10px;
        }
        
        .cv-action-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .cv-action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .cv-name {
            font-size: 1.5rem;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .cv-title {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 400;
        }
        
        .cv-body {
            padding: 20px;
            flex-grow: 1;
        }
        
        .cv-detail {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .cv-detail-label {
            font-weight: 600;
            min-width: 140px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .cv-detail-label i {
            color: var(--primary-color);
            width: 20px;
        }
        
        .cv-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }
        
        .skill-tag {
            background-color: var(--light-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .skill-tag i {
            color: var(--primary-color);
            font-size: 0.7rem;
        }
        
        .cv-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9fafb;
        }
        
        .cv-date {
            font-size: 0.9rem;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-view {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-view:hover {
            background-color: var(--secondary-color);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 40px;
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin: 40px 0;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .empty-state h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--dark-color);
        }
        
        .empty-state p {
            margin-bottom: 25px;
            color: var(--text-color);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-add-large {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-add-large:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }
        
        .pagination-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .pagination-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination-btn:hover:not(.active) {
            background: var(--light-color);
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-sort {
                justify-content: center;
            }
            
            .cv-list {
                grid-template-columns: 1fr;
            }
            
            .cv-detail {
                flex-direction: column;
                gap: 5px;
            }
            
            .cv-detail-label {
                min-width: unset;
            }
        }
    </style>
</head>
<body>
<header>
<div class="container">
<div class="header-content">
<h1><i class="fas fa-file-alt"></i> Candidatures pour l'offre </h1>
<div class="user-info">
<div class="user-avatar">JD</div>
<div>Recruteur</div>
</div>
</div>
</div>
</header>

<div class="container">
<div class="controls">
<div class="search-box">
<i class="fas fa-search"></i>
<input type="text" placeholder="Rechercher un CV...">
</div>

<div class="filter-sort">
<button class="filter-btn">
<i class="fas fa-filter"></i> Filtres
</button>
<button class="sort-btn">
<i class="fas fa-sort"></i> Trier
</button>
</div>
</div>

<div class="cv-list">
<?php if (!empty($cvs)): ?>
<?php foreach ($cvs as $cv): ?>
<div class="cv-card">
<div class="cv-header">
<div class="cv-actions">

<i class="fas fa-download"></i>
</a>
</div>
<h2 class="cv-name"><?= htmlspecialchars($cv['Nom'] . " " . $cv['Prenom']) ?></h2>
<p class="cv-title"><?= htmlspecialchars($cv['diploma_name'] ?? 'N/A') ?></p>
</div>

<div class="cv-body">
<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-envelope"></i> Email:</span>
<span><?= htmlspecialchars($cv['Mail']) ?></span>
</div>

<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-phone"></i> Téléphone:</span>
<span><?= htmlspecialchars($cv['phone']) ?></span>
</div>

<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-map-marker-alt"></i> Adresse:</span>
<span><?= htmlspecialchars($cv['address']) ?></span>
</div>

<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-chart-line"></i> Expérience:</span>
<span><?= htmlspecialchars($cv['experience_year']) ?> ans</span>
</div>

<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-euro-sign"></i> Salaire souhaité:</span>
<span><?= htmlspecialchars($cv['salaire_souhaite']) ?> €</span>
</div>

<div class="cv-detail">
<span class="cv-detail-label"><i class="fas fa-star"></i> Compétences:</span>
<div class="cv-skills">
<?php foreach (explode(',', $cv['languages'] ?? '') as $lang): ?>
<?php if (trim($lang) !== ''): ?>
<span class="skill-tag"><i class="fas fa-check"></i> <?= htmlspecialchars(trim($lang)) ?></span>
<?php endif; ?>
<?php endforeach; ?>
</div>
</div>
</div>

<div class="cv-footer">
<span class="cv-date">
<i class="far fa-calendar-alt"></i>
Déposé le: <?= htmlspecialchars($cv['date_depot']) ?>
</span>
<a href="/cv/view?id=<?= $cv['cv_id'] ?>" class="btn btn-view">
<i class="fas fa-eye"></i> Voir
</a>
</div>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>Aucun CV trouvé pour cette offre.</p>
<?php endif; ?>
</div>
</div>
</body>


</html>
