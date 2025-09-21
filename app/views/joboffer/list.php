<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Liste des Offres</h2>
<a href="/addjob">➕ Ajouter une offre</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Département</th>
        <th>Lieu</th>
        <th>Date limite</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($offers as $offer): ?>
        <tr>
            <td><?= $offer['id'] ?></td>
            <td><?= $offer['title'] ?></td>
            <td><?= $offer['department_name'] ?></td>
            <td><?= $offer['locations'] ?></td>
            <td><?= $offer['deadline'] ?></td>
            <td>
                <a href="/job/<?= $offer['id'] ?>">👁 Voir</a>
                <a href="/apply/<?= $offer['id'] ?>">Postuler</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>