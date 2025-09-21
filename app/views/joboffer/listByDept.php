<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Offres du département</h2>

<?php if(empty($offers)): ?>
    <p>Aucune offre pour ce département.</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Titre</th>
            <th>Lieu</th>
            <th>Date limite</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach($offers as $offer): ?>
        <tr>
            <td><?= htmlspecialchars($offer['title']) ?></td>
            <td><?= htmlspecialchars($offer['locations']) ?></td>
            <td><?= $offer['deadline'] ?></td>
            <td><?= $offer['is_active'] ? "Validée" : "En attente" ?></td>
            <td>
                <a href="/offers/edit?id=<?= $offer['id'] ?>">✏️ Modifier</a> | 
                <a href="/offers/delete?id=<?= $offer['id'] ?>" onclick="return confirm('Supprimer cette offre ?')">🗑️ Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>