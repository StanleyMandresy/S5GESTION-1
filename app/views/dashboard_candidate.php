<?php include __DIR__ . '/header.php'; ?>

<main class="container mx-auto px-4 flex-grow">

    <!-- Titre principal -->
    <h1 class="text-center text-5xl font-extrabold tracking-tight mb-12 animate__animated animate__fadeInDown 
        text-[#5D726F] drop-shadow-lg">
        🌿 Dashboard Candidat
    </h1>

    <!-- Statistiques -->
    <div class="row g-4 mb-12">
        <?php $statsArray = [
            ['label'=>'Total candidatures','value'=>$stats['total_applications'] ?? 0,'icon'=>'bi-file-earmark-text'],
            ['label'=>'QCM en cours','value'=>$stats['qcms_pending'] ?? 0,'icon'=>'bi-journal-check'],
            ['label'=>'Entretiens prévus','value'=>$stats['interviews_upcoming'] ?? 0,'icon'=>'bi-calendar-event']
        ]; ?>
        <?php foreach($statsArray as $index => $s): ?>
        <div class="col-md-4">
            <div class="card bg-[#DCDED6] bg-opacity-60 backdrop-blur-md border-0 text-center shadow-lg p-6 
                        rounded-4 hover:scale-105 transition-transform duration-300 ease-in-out 
                        animate__animated animate__fadeInUp animate__delay-<?= $index ?>s">
                <i class="bi <?= $s['icon'] ?> fs-1 mb-3 text-[#5D726F]"></i>
                <h5 class="text-[#859393] font-semibold"><?= $s['label'] ?></h5>
                <p class="display-6 font-bold text-[#5D726F]"><?= $s['value'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Profil -->
    <section class="card bg-white shadow-lg p-6 mb-10 rounded-4 border-l-4 border-[#5D726F] 
                    hover:shadow-xl transition duration-300 animate__animated animate__fadeInLeft">
        <h2 class="text-[#5D726F] mb-4 flex items-center gap-2 font-bold text-xl">
            <i class="bi bi-person-badge"></i> Profil
        </h2>
        <p><strong>Nom :</strong> <?= htmlspecialchars($profile['first_name'].' '.$profile['last_name']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($profile['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($profile['phone'] ?? '-') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($profile['address'] ?? '-') ?></p>
        <?php if(!empty($profile['resume_path'])): ?>
            <a href="/candidate/download/<?= $profile['id'] ?>" 
               class="btn btn-outline-success mt-4 rounded-pill shadow-sm hover:scale-105 transition">
                <i class="bi bi-download me-1"></i> Télécharger CV
            </a>
        <?php endif; ?>
    </section>

    <!-- Offres d'emploi -->
    <section class="card shadow-lg p-6 mb-12 rounded-4 bg-[#CED0C3] bg-opacity-50 backdrop-blur-sm 
                    animate__animated animate__fadeInUp">
        <h2 class="text-[#5D726F] mb-4 flex items-center gap-2 font-bold text-xl">
            <i class="bi bi-briefcase-fill"></i> Offres d'emploi disponibles
        </h2>

        <?php if (!empty($jobOffers)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($jobOffers as $offer): ?>
        <div class="col">
        <div class="card h-100 shadow-md border-0 rounded-4 hover:shadow-xl hover:scale-105 transition duration-300">
            <div class="card-body">
                <h5 class="card-title text-[#5D726F] font-bold mb-2">
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
        <p class="text-center text-muted">Aucune offre disponible pour le moment.</p>
        <?php endif; ?>
    </section>

    <!-- Bouton Retour -->
    <div class="flex justify-center mb-12">
        <a href="/login" class="btn btn-outline-danger btn-lg rounded-pill shadow hover:scale-105 transition">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour vers Connexion
        </a>
    </div>

</main>

<?php include __DIR__ . '/footer.php'; ?>
