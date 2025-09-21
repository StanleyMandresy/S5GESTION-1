<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Ajouter une offre</h2>
<form method="POST" action="/job">
    <label>Titre :</label>
    <input type="text" name="title" required><br>

    <label>Description :</label>
    <textarea name="description" required></textarea><br>

    <label>Département :</label>
    <select name="department_id" required>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Lieu :</label>
    <input type="text" name="locations" required><br>

    <label>Date limite :</label>
    <input type="date" name="deadline" required><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>