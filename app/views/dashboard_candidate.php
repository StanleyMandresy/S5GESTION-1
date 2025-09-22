<?php include __DIR__ . '/header.php'; ?>

<style>
    :root {
        --color-light: #DCDED6;
        --color-light-accent: #CED0C3;
        --color-medium: #B4BAB1;
        --color-dark-accent: #859393;
        --color-dark: #5D726F;
    }

    body {
        background-color: var(--color-light);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--color-dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main.container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
        flex-grow: 1;
    }

    h1 {
        font-size: 3rem;
        font-weight: 800;
        color: var(--color-dark);
        text-align: center;
        margin-bottom: 2.5rem;
    }

    /* Statistiques */
    .card {
        background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(93, 114, 111, 0.15);
        padding: 25px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(93, 114, 111, 0.2);
    }

    .card h2, .card h5, .card h6 {
        color: var(--color-dark);
    }

    .card p {
        color: var(--color-dark-accent);
    }

    /* Profil */
    .card.border-l-4 {
        border-left-width: 4px;
        border-left-color: var(--color-dark);
    }

    .btn-success {
        background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
        color: white;
    }

    /* Dashboard Offres d'emploi */
    .bg-light-accent {
        background-color: var(--color-light-accent);
    }

    .bg-opacity-80 {
        background-color: rgba(206, 208, 195, 0.8);
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(5px);
    }

    .transition {
        transition: all 0.3s ease;
    }

    .hover\:shadow-xl:hover {
        box-shadow: 0 15px 30px rgba(93, 114, 111, 0.2) !important;
    }

    .hover\:scale-105:hover {
        transform: scale(1.05);
    }

    .hover\:scale-110:hover {
        transform: scale(1.10);
    }

    /* Bouton Retour */
    .btn-outline-danger {
        border: 2px solid #d9534f;
        color: #d9534f;
        background-color: transparent;
    }

    .btn-outline-danger:hover {
        background-color: #d9534f;
        color: white;
    }
</style>

<main class="container mx-auto px-4 flex-grow py-8">

    <!-- Titre principal -->
    <h1>🌿 Dashboard Candidat</h1>

    <!-- Statistiques -->
    <div class="row g-4 mb-12">
        <?php 
        $statsArray = [
            ['label'=>'Total candidatures','value'=>$stats['total_applications'] ?? 0,'icon'=>'bi-file-earmark-text'],
            ['label'=>'QCM en cours','value'=>$stats['qcms_pending'] ?? 0,'icon'=>'bi-journal-check'],
            ['label'=>'Entretiens prévus','value'=>$stats['interviews_upcoming'] ?? 0,'icon'=>'bi-calendar-event']
        ]; 
        ?>
        <?php foreach($statsArray as $index => $s): ?>
        <div class="col-md-4">
            <div class="card text-center shadow-lg p-6 rounded-4 hover:scale-105 transition-transform duration-300">
                <i class="bi <?= $s['icon'] ?> fs-1 mb-3 text-[var(--color-dark)]"></i>
                <h5 class="text-[var(--color-dark-accent)] font-semibold"><?= $s['label'] ?></h5>
                <p class="display-6 font-bold text-[var(--color-dark)]"><?= $s['value'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Profil -->
    <section class="card shadow-lg p-6 mb-10 rounded-4 border-l-4 hover:shadow-xl transition duration-300">
        <h2 class="text-[var(--color-dark)] mb-4 flex items-center gap-2 font-bold text-xl">
            <i class="bi bi-person-badge"></i> Profil
        </h2>
        <p><strong>Nom :</strong> <?= htmlspecialchars($profile['first_name'].' '.$profile['last_name']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($profile['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($profile['phone'] ?? '-') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($profile['address'] ?? '-') ?></p>
        <?php if(!empty($profile['resume_path'])): ?>
            <a href="/candidate/download/<?= $profile['id'] ?>" class="btn btn-success mt-4 rounded-pill shadow-sm hover:scale-105 transition">
                <i class="bi bi-download me-1"></i> Télécharger CV
            </a>
        <?php endif; ?>
    </section>

    <!-- Offres d'emploi -->
    <section class="card shadow-lg p-6 mb-12 rounded-4 bg-light-accent bg-opacity-80 backdrop-blur-sm transition">
        <h2 class="text-[var(--color-dark)] mb-4 flex items-center gap-2 font-bold text-xl">
            <i class="bi bi-briefcase-fill"></i> Offres d'emploi disponibles
        </h2>

        <?php if (!empty($jobOffers)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($jobOffers as $offer): ?>
            <div class="col">
                <div class="card h-100 shadow-md border-0 rounded-4 hover:shadow-xl hover:scale-105 transition duration-300">
                    <div class="card-body">
                        <h5 class="card-title text-[var(--color-dark)] font-bold mb-2">
                            <i class="bi bi-briefcase-fill me-2"></i>
                            <?= htmlspecialchars($offer['title']) ?>
                        </h5>
                        <h6 class="card-subtitle text-[var(--color-dark-accent)] mb-3">
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

                    <div class="card-footer bg-transparent border-0 text-end">
                        <form action="/cv/form" method="POST" class="d-inline">
                            <input type="hidden" name="job_offer_id" value="<?= $offer['id'] ?>">
                            <button type="submit" class="btn btn-success btn-sm rounded-pill shadow-sm hover:scale-110 transition">
                                <i class="bi bi-send-fill me-1"></i> Postuler
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="text-center text-[var(--color-dark-accent)]">Aucune offre disponible pour le moment.</p>
        <?php endif; ?>
    </section>

    <!-- Bouton Retour -->
    <div class="d-flex justify-content-center mb-12">
        <a href="/login" class="btn btn-outline-danger btn-lg rounded-pill shadow hover:scale-105 transition">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour vers Connexion
        </a>
    </div>

</main>

<?php include __DIR__ . '/footer.php'; ?>
