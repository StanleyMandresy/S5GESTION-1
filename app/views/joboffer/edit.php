<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Créer une offre d'emploi</h2>

<form method="POST" action="/offers/store">
    <label>Titre :</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description :</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Lieu :</label><br>
    <input type="text" name="locations" required><br><br>

    <label>Date limite :</label><br>
    <input type="date" name="deadline" required><br><br>

    <label>Diplôme requis :</label><br>
    <input type="text" name="diploma"><br><br>

    <label>Niveau d'expérience :</label><br>
    <input type="text" name="experience_level"><br><br>

    <label>Avantages :</label><br>
    <textarea name="benefits"></textarea><br><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>