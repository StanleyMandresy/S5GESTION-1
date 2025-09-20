<h3>Planifier un entretien</h3>
<form method="POST" action="/entretien/create">
    <label for="idCandidat">Candidat :</label>
    <select name="idCandidat" id="idCandidat" required>
        <?php foreach($candidats as $candidat): ?>
            <option value="<?= $candidat['id'] ?>"><?= htmlspecialchars($candidat['Nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="date_heure_debut">Date et heure de début :</label>
    <input type="datetime-local" name="date_heure_debut" id="date_heure_debut" required>

    <button type="submit">Planifier</button>
</form>
