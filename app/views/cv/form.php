<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Créer mon CV</title>
</head>
<body>
<h2>Créer mon CV</h2>

<form method="POST" action="/cv/submit">
<?php if (isset($_POST['job_offer_id'])): ?>
<input type="hidden" name="job_offer_id" value="<?= htmlspecialchars($_POST['job_offer_id']) ?>">
<?php endif; ?>

<label>Diplôme :</label><br>
<select name="diploma_id" required>
<option value="">-- Sélectionner --</option>
<?php foreach ($diplomas as $diploma): ?>
<option value="<?= $diploma['id'] ?>"><?= htmlspecialchars($diploma['name']) ?></option>
<?php endforeach; ?>
</select><br><br>

<label>Niveau d'étude :</label><br>
<select name="level" required>
<option value="">-- Sélectionner --</option>
<option value="1">Bac +1</option>
<option value="2">Bac +2</option>
<option value="3">Bac +3 Licence</option>
<option value="4">Bac +4 / Master 1</option>
<option value="5">Bac +5 / Master 2</option>
</select><br><br>


<label>Années d'expérience :</label><br>
<input type="number" name="experience_year" min="0"><br><br>

<label>Langues :</label><br>
<input type="text" name="languages"><br><br>

<label>Avantages souhaités :</label><br>
<textarea name="avantages"></textarea><br><br>

<label>Atouts :</label><br>
<textarea name="atout"></textarea><br><br>

<label>Salaire souhaité :</label><br>
<input type="number" step="0.01" name="salaire_souhaite"><br><br>



<button type="submit">Enregistrer</button>
</form>
</body>
</html>
