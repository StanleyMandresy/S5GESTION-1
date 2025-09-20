<!-- app/views/ContractDisplay.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Travail</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 40px; }
        .contract-header { text-align: center; margin-bottom: 30px; }
        .contract-section { margin-bottom: 20px; }
        .contract-title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .signature-section { margin-top: 50px; }
        .signature { width: 300px; border-top: 1px solid #000; margin-top: 60px; }
    </style>
</head>
<body>
    <?php if (isset($contract)): ?>
        <div class="contract-header">
            <h1>CONTRAT DE TRAVAIL À ESSAI</h1>
        </div>
        
        <div class="contract-section">
            <p>Entre la société :</p>
            <p><strong><?= htmlspecialchars($contract['company_name'] ?? 'Nom de l\'Entreprise') ?></strong>, 
            au capital de <?= htmlspecialchars($contract['capital'] ?? 'Montant du Capital') ?>, 
            immatriculée au RCS de <?= htmlspecialchars($contract['rcs_city'] ?? 'Ville') ?> 
            sous le numéro <?= htmlspecialchars($contract['rcs_number'] ?? 'Numéro RCS/SIRET') ?>, 
            dont le siège social est situé <?= htmlspecialchars($contract['headquarters_address'] ?? 'Adresse complète du siège social') ?>,</p>
            <p>Ci-après dénommée « l'Employeur », d'une part,</p>
        </div>
        
        <div class="contract-section">
            <p>Et :</p>
            <p>Monsieur/Madame <strong><?= htmlspecialchars($contract['first_name'] . ' ' . $contract['last_name']) ?></strong>,</p>
            <p>Né(e) le 23 janvier 2005 à Antananarivo ,</p>
            <p>Demeurant Mahamasina</p>
            <p>Ci-après dénommé « le Salarié », d'autre part,</p>
        </div>
        
        <div class="contract-section">
            <p class="contract-title">IL A ÉTÉ CONVENU CE QUI SUIT :</p>
        </div>
        
        <!-- ARTICLE 1 - OBJET -->
        <div class="contract-section">
            <p class="contract-title">ARTICLE 1 – OBJET</p>
            <p>Le présent contrat a pour objet d'engager le Salarié en qualité de <strong>Paysagiste</strong> 
            en vue de la réalisation des missions décrites à l'article 3. Il est conclu pour la durée de la période d'essai définie à l'article 2.</p>
        </div>
        
        <!-- ARTICLE 2 - PÉRIODE D'ESSAI -->
        <div class="contract-section">
            <p class="contract-title">ARTICLE 2 – PÉRIODE D'ESSAI</p>
            <p>Une période d'essai est prévue pour permettre à l'Employeur d'évaluer les compétences du Salarié et pour permettre au Salarié d'apprécier si les fonctions lui conviennent.</p>
            <p><strong>Durée :</strong> La période d'essai est fixée à <?= $contract['probation_duration'] ?> mois 
            <?= $contract['probation_renewable'] ? 'renouvelable 1 fois pour une durée identique, soit une durée maximale de ' . ($contract['probation_duration'] * 2) . ' mois' : 'non renouvelable' ?>.</p>
            <p><strong>Début :</strong> La période d'essai débutera le <?= date('d/m/Y', strtotime($contract['start_date'])) ?>.</p>
            <p><strong>Rupture :</strong> La période d'essai peut être rompue à tout moment par l'une ou l'autre des parties, sans indemnité, sous réserve du respect d'un préavis :</p>
            <ul>
                <li>Pendant la 1ère semaine : 24 heures de préavis.</li>
                <li>Entre 8 jours et 1 mois d'ancienneté : 48 heures de préavis.</li>
                <li>Après 1 mois d'ancienneté : 2 semaines de préavis.</li>
            </ul>
            <p>La rupture doit être notifiée par écrit (lettre recommandée avec accusé de réception ou remise en main propre contre décharge).</p>
        </div>
        
        <!-- ARTICLE 3 - MISSIONS -->
        <div class="contract-section">
            <p class="contract-title">ARTICLE 3 – MISSIONS</p>
            <p>Le Salarié est engagé en qualité de <strong>Paysagiste</strong>. À ce titre, il exercera les missions suivantes, qui pourront évoluer en fonction des besoins de l'entreprise :</p>
            <ul>
                <?php foreach ($contract['missions'] as $mission): ?>
                    <li><?= htmlspecialchars($mission) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <!-- Autres articles avec les données du contrat -->
        <div class="contract-section">
            <p class="contract-title">ARTICLE 5 – DURÉE DU TRAVAIL ET RÉMUNÉRATION</p>
            <p><strong>Durée :</strong> La durée légale de travail est de <?= $contract['work_hours_per_week'] ?> heures par semaine.</p>
            <p><strong>Rémunération brute mensuelle :</strong> La rémunération brute du Salarié est fixée à <?= $contract['remuneration'] ?> euros pour 151,67 heures de travail, soit un taux horaire de <?= $contract['remuneration_hourly'] ?> euros.</p>
        </div>
        
        <!-- Affichage des clauses supplémentaires -->
        <?php foreach ($contract['clauses'] as $clause): ?>
            <div class="contract-section">
                <p class="contract-title"><?= htmlspecialchars($clause['clause_title']) ?></p>
                <p><?= nl2br(htmlspecialchars($clause['clause_text'])) ?></p>
            </div>
        <?php endforeach; ?>
        
        <!-- Signatures -->
        <div class="signature-section">
            <p>Fait à <?= htmlspecialchars($contract['rcs_city'] ?? 'Lieu de rédaction') ?>, le <?= date('d/m/Y') ?></p>
            <p>En deux exemplaires originaux,</p>
            
            <div style="display: flex; justify-content: space-between; margin-top: 50px;">
                <div>
                    <p>Pour l'Employeur,</p>
                    <div class="signature"></div>
                    <p>Fonction : Directeur/Gérant</p>
                </div>
                
                <div>
                    <p>Le Salarié,</p>
                    <div class="signature"></div>
                    <p><?= htmlspecialchars($contract['first_name'] . ' ' . $contract['last_name']) ?></p>
                </div>
            </div>
        </div>
        
    <?php else: ?>
        <p>Aucun contrat trouvé.</p>
    <?php endif; ?>
</body>
</html>