
<style>
/* Corps de page */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e8f5e9; /* vert très clair */
    padding: 20px;
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
    background-color: #4caf50; /* vert */
    color: white;
    text-align: left;
}

.table th, .table td {
    padding: 12px 15px;
}

/* Lignes impaires */
.table tbody tr:nth-child(odd) {
    background-color: #f1f8f3; /* vert très pâle */
}

/* Lignes au survol */
.table tbody tr:hover {
    background-color: #c8e6c9; /* vert clair */
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
</style>

<form action="/entretien/listeEntretien" method="POST">
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
