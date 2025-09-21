<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Offres d'emploi par département</h2>

    <!-- Formulaire de sélection de département -->
    <form method="get" action="">
        <label for="department_id">Choisissez un département :</label>
        <select name="department_id" id="department_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>" <?= (!empty($selected_department) && $selected_department == $dept['id']) ? 'selected' : '' ?>><?= htmlspecialchars($dept['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Voir les offres</button>
    </form>

    <?php if (!empty($selected_department)): ?>
        <?php if(empty($offers)): ?>
            <p>Aucune offre disponible pour ce département.</p>
        <?php else: ?>
            <table border="1" cellpadding="5">
                <tr>
                    <th>Titre</th>
                    <th>Lieu</th>
                    <th>Date limite</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($offers as $offer): ?>
                <tr>
                    <td><?= htmlspecialchars($offer['title']) ?></td>
                    <td><?= htmlspecialchars($offer['locations']) ?></td>
                    <td><?= $offer['deadline'] ?></td>
                    <td>
                        <?php if (strtotime($offer['deadline']) >= time()): ?>
                            <a href="/cv/form?job_offer_id=<?= $offer['id'] ?>">Postuler</a>
                        <?php else: ?>
                            <span style="color:gray;">Date limite dépassée</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>