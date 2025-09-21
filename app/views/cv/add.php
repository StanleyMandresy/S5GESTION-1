<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Ajouter un CV</h2>
<form method="POST" action="/cv">
    <label>Nom :</label>
    <input type="text" name="nom" required><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label>Email :</label>
    <input type="email" name="email" required><br>

    <label>Titre recherché :</label>
    <input type="text" name="titre_poste" required><br>

    <label>Description :</label>
    <textarea name="description"></textarea><br>

    <label>Compétences :</label>
    <textarea name="skills"></textarea><br>

    <label>Lieu :</label>
    <input type="text" name="location" required><br>

    <label>Date de dépôt :</label>
    <input type="date" name="date_depot" required><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>