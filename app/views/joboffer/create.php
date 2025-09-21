<form method="POST" action="/offers/create">
<label>Titre :</label><br>
<input type="text" name="title" required><br><br>

<label>Description :</label><br>
<textarea name="description" required></textarea><br><br>

<label>Département :</label><br>
<select name="department_id" required>
<?php foreach ($departments as $dept): ?>
<option value="<?= htmlspecialchars($dept['id']) ?>">
<?= htmlspecialchars($dept['name']) ?>
</option>
<?php endforeach; ?>
</select><br><br>

<input type="hidden" name="is_active" value="1">

<label>Lieu :</label><br>
<input type="text" name="locations" required><br><br>

<label>Date limite :</label><br>
<input type="date" name="deadline" required><br><br>

<label>Diplôme :</label><br>
<select name="diploma_id" required>
<?php foreach ($diplomas as $diploma): ?>
<option value="<?= htmlspecialchars($diploma['id']) ?>">
<?= htmlspecialchars($diploma['name']) ?>
</option>
<?php endforeach; ?>
</select><br><br>

<label>Niveau (diplôme) :</label><br>
<select name="level" required>
<option value="1">Bac +1</option>
<option value="3">Bac +3 Licence</option>
<option value="4">Bac +4 Master 1</option>
<option value="5">Bac +5 Master 2</option>
</select><br><br>

<label>Expérience (en années) :</label><br>
<input type="number" name="experience_year" min="0"><br><br>

<label>Avantages :</label><br>
<textarea name="benefits"></textarea><br><br>

<button type="submit">Enregistrer</button>
</form>
