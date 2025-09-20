<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des candidats</title>
</head>
<body>
    <h1>Liste des candidats</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($candidats as $candidat): ?>
        <tr>
            <td><?= htmlspecialchars($candidat['Nom']) ?></td>
            <td><?= htmlspecialchars($candidat['Mail']) ?></td>
            <td>
                <!-- Formulaire pour acceptation -->
                <form method="post" action="/Notification" style="display:inline;">
                    <input type="hidden" name="idCandidat" value="<?= $candidat['id'] ?>">
                    <input type="hidden" name="idType" value="acceptation">
                    <button type="submit">Envoyer Acceptation ✅</button>
                </form>

                <!-- Formulaire pour rejet -->
                <form method="post" action="/Notification" style="display:inline;">
                    <input type="hidden" name="idCandidat" value="<?= $candidat['id'] ?>">
                    <input type="hidden" name="idType" value="rejet">
                    <button type="submit">Envoyer Rejet ❌</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
