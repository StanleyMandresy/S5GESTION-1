<style>
/* Corps de page */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e8f5e9;
    padding: 20px;
}

/* Formulaire de sélection */
.selection-form {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.selection-form select, .selection-form button {
    padding: 10px 15px;
    border: 1px solid #4caf50;
    border-radius: 4px;
    font-size: 16px;
    margin-right: 10px;
}

.selection-form select {
    width: 300px;
    background-color: white;
}

.selection-form button {
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.selection-form button:hover {
    background-color: #45a049;
}

/* Table */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

/* En-tête */
.table thead {
    background-color: #4caf50;
    color: white;
    text-align: left;
}

.table th, .table td {
    padding: 12px 15px;
}

/* Lignes impaires */
.table tbody tr:nth-child(odd) {
    background-color: #f1f8f3;
}

/* Lignes au survol */
.table tbody tr:hover {
    background-color: #c8e6c9;
    transition: 0.3s;
}

/* Inputs */
input[type="number"] {
    width: 60px;
    padding: 5px;
    border: 1px solid #4caf50;
    border-radius: 4px;
}

/* Boutons */
button[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Message d'information */
.info-message {
    background-color: #e3f2fd;
    border: 1px solid #2196f3;
    border-radius: 4px;
    padding: 15px;
    margin: 20px 0;
    text-align: center;
    color: #1976d2;
}
</style>

<!-- Formulaire de sélection de l'offre -->
<div class="selection-form">
<form method="GET" action="">
<label for="offre"><strong>Sélectionner une offre d'emploi :</strong></label>
<select name="offre" id="offre" required>
<option value="">-- Choisir une offre --</option>
<?php foreach ($jobOffers as $offer): ?>
<option value="<?= $offer['id'] ?>"
<?= ($selectedOffre == $offer['id']) ? 'selected' : '' ?>>
<?= htmlspecialchars($offer['title']) ?>
</option>
<?php endforeach; ?>
</select>
<button type="submit">📋 Afficher les candidats</button>
</form>
</div>

<?php if ($selectedOffre && empty($candidats)): ?>
<div class="info-message">
ℹ️ Aucun candidat trouvé pour cette offre d'emploi au stade 3.
</div>
<?php elseif ($selectedOffre && !empty($candidats)): ?>
<!-- Formulaire d'évaluation des candidats -->
<form action="/entretien/listeEntretien" method="POST">
<input type="hidden" name="idOffre" value="<?= $selectedOffre ?>">

<table class="table">
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Date Entretien</th>
<th>Note RH</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php foreach ($candidats as $c): ?>
<tr>
<td><?= htmlspecialchars($c['Nom']) ?></td>
<td><?= htmlspecialchars($c['Prenom']) ?></td>
<td><?= $c['Date_heure_debut'] ?></td>
<td>
<input type="number"
name="notes[<?= $c['entretien_id'] ?>]"
value="<?= $c['NotesRH'] ?? '' ?>"
min="0" max="20">
</td>
<td>
<button type="submit" name="save" value="<?= $c['entretien_id'] ?>">
💾 Sauvegarder
</button>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</form>
<?php elseif (!$selectedOffre): ?>
<div class="info-message">
🔍 Veuillez sélectionner une offre d'emploi pour afficher les candidats.
</div>
<?php endif; ?>
