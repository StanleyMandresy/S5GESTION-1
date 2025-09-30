
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
