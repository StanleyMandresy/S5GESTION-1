<h1>Bienvenue, <?= htmlspecialchars($profile['first_name'].' '.$profile['last_name']) ?></h1>

<?php include __DIR__ . '/header.php'; ?>
<link rel="stylesheet" href="/assets/css/employee.css">

<!-- Notifications -->

<!-- Missions -->


<!-- Planning -->
<section class="card shadow-sm p-4 mb-6 rounded-4 animate__animated animate__fadeInUp">
<h2 class="text-primary mb-3">
<i class="bi bi-briefcase-fill me-2"></i> Offres d'emploi disponibles
</h2>

<?php if (!empty($jobOffers)): ?>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
<?php foreach ($jobOffers as $offer): ?>
<div class="col">
<div class="card h-100 shadow-sm border-0 rounded-4">
<div class="card-body">
<h5 class="card-title text-primary mb-2">
<i class="bi bi-briefcase-fill me-2"></i>
<?= htmlspecialchars($offer['title']) ?>
</h5>
<h6 class="card-subtitle text-muted mb-3">
<i class="bi bi-building me-2"></i>
<?= htmlspecialchars($offer['department'] ?? '-') ?>
</h6>

<p class="mb-2">
<i class="bi bi-geo-alt-fill me-2"></i>
<strong>Lieu :</strong> <?= htmlspecialchars($offer['locations'] ?? '-') ?>
</p>

<p class="mb-2">
<i class="bi bi-mortarboard-fill me-2"></i>
<strong>Diplôme requis :</strong> <?= htmlspecialchars($offer['diploma'] ?? '-') ?>
</p>

<p class="mb-2">
<i class="bi bi-award-fill me-2"></i>
<strong>Expérience :</strong> <?= htmlspecialchars($offer['experience_level'] ?? '-') ?>
</p>

<p class="mb-2">
<i class="bi bi-calendar-event me-2"></i>
<strong>Date limite :</strong> <?= htmlspecialchars($offer['deadline'] ?? '-') ?>
</p>

<p class="text-muted small">
<?= nl2br(htmlspecialchars(substr($offer['description'], 0, 150))) ?>...
</p>
</div>

<div class="card-footer bg-white border-0 text-end">
<div class="card-footer bg-white border-0 text-end">
<a href="/cv/job/<?= $offer['id'] ?>" class="btn btn-primary btn-sm rounded-pill">
<i class="bi bi-eye-fill me-1"></i> Voir les candidatures
</a>
</div>
</form>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php else: ?>
<p>Aucune offre disponible pour le moment.</p>
<?php endif; ?>
</section>


<!-- Retour connexion -->
<p>
    <a href="/login" class="back-btn">← Retour vers Connexion</a>
</p>
