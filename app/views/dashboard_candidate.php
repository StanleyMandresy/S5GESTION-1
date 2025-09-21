<?php include __DIR__ . '/header.php'; ?>

<main class="container mx-auto px-4 flex-grow">

    <h1 class="text-center text-4xl text-primary fw-bold mb-10 animate__animated animate__fadeInDown">
        Dashboard Candidat
    </h1>

    <!-- Statistiques -->
    <div class="row g-4 mb-6">
        <?php $statsArray = [
            ['label'=>'Total candidatures','value'=>$stats['total_applications'] ?? 0,'icon'=>'bi-file-earmark-text'],
            ['label'=>'QCM en cours','value'=>$stats['qcms_pending'] ?? 0,'icon'=>'bi-journal-check'],
            ['label'=>'Entretiens prévus','value'=>$stats['interviews_upcoming'] ?? 0,'icon'=>'bi-calendar-event']
        ]; ?>
        <?php foreach($statsArray as $index => $s): ?>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-4 rounded-4 hover-shadow animate__animated animate__fadeInUp animate__delay-<?= $index ?>s">
                <i class="bi <?= $s['icon'] ?> fs-1 mb-2 text-secondary"></i>
                <h5 class="text-secondary"><?= $s['label'] ?></h5>
                <p class="display-6 text-primary"><?= $s['value'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Profil -->
    <section class="card shadow-sm p-4 mb-6 rounded-4 animate__animated animate__fadeInLeft">
        <h2 class="text-primary mb-3"><i class="bi bi-person-badge me-2"></i> Profil</h2>
        <p><strong>Nom :</strong> <?= htmlspecialchars($profile['first_name'].' '.$profile['last_name']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($profile['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($profile['phone'] ?? '-') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($profile['address'] ?? '-') ?></p>
        <?php if(!empty($profile['resume_path'])): ?>
            <a href="/candidate/download/<?= $profile['id'] ?>" class="btn btn-outline-primary mt-3">
                <i class="bi bi-download me-1"></i> Télécharger CV
            </a>
        <?php endif; ?>
    </section>

    <!-- Documents -->


    <!-- Offres d'emploi -->
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
    <form action="/cv/form" method="POST" class="d-inline">
    <input type="hidden" name="job_offer_id" value="<?= $offer['id'] ?>">
    <button type="submit" class="btn btn-success btn-sm rounded-pill">
    <i class="bi bi-send-fill me-1"></i> Postuler
    </button>
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




    <!-- Bouton Retour -->
    <div class="d-flex justify-content-center mb-10">
        <a href="/login" class="btn btn-outline-danger btn-lg">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour vers Connexion
        </a>
    </div>

</main>

<?php include __DIR__ . '/footer.php'; ?>
