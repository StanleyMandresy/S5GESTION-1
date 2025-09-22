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
<input type="number" id="note-<?= $c['entretien_id'] ?>"
value="<?= $c['NotesRH'] ?? '' ?>" min="0" max="20">
</td>
<td>
<button onclick="saveNote(<?= $c['entretien_id'] ?>)">💾 Sauvegarder</button>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<script>
function saveNote(entretienId) {
    let note = document.getElementById("note-" + entretienId).value;

    fetch('/entretien/updateNoteRH', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: entretienId, noteRH: note })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    });
}
</script>
