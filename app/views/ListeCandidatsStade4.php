<h2>Liste des candidats (Stade 4)</h2>

<table class="table table-bordered">
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Total Points</th>
<th>Note QCM (Notes)</th>
<th>Note RH</th>
<th>Moyenne</th>
</tr>
</thead>
<tbody>
<?php foreach ($candidats as $c): ?>
<tr>
<td><?= htmlspecialchars($c['Nom']) ?></td>
<td><?= htmlspecialchars($c['Prenom']) ?></td>
<td><?= $c['totalPoints'] ?? '-' ?></td>
<td><?= $c['Notes'] ?? '-' ?></td>
<td><?= $c['NotesRH'] ?? '-' ?></td>
<td><strong><?= $c['moyenne'] ?></strong></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
