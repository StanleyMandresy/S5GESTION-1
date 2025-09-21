<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Mes CV</h2>
<a href="/addcv">➕ Ajouter un CV</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Titre recherché</th>
        <th>Compétences</th>
        <th>Date de dépôt</th>
    </tr>
    <?php foreach ($cvs as $cv): ?>
        <tr>
            <td><?= $cv['id'] ?></td>
            <td><?= $cv['nom'] . " " . $cv['prenom'] ?></td>
            <td><?= $cv['titre_poste'] ?></td>
            <td><?= $cv['skills'] ?></td>
            <td><?= $cv['date_depot'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>