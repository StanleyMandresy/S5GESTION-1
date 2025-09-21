<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription</title>
<link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>

<div class="container">
<h1>Inscription</h1>

<?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form action="/register" method="POST" autocomplete="off">
<input type="text" name="first_name" placeholder="Prénom" required autocomplete="off">
<input type="text" name="last_name" placeholder="Nom" required autocomplete="off">
<input type="email" name="email" placeholder="Email" required autocomplete="off">
<input type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">

<select name="role" id="roleSelect" required>
<option value="candidate">Candidat</option>
<option value="employee">Employé</option>
<option value="admin">Admin</option>
</select>

<!-- Champ Département -->
<!-- Champ Département -->
<div id="departmentField" style="display:none;">
<select name="idDepartement">
<option value="">-- Sélectionnez un département --</option>
<?php foreach ($departments as $dept): ?>
<option value="<?= htmlspecialchars($dept['id']) ?>">
<?= htmlspecialchars($dept['name']) ?>
</option>
<?php endforeach; ?>
</select>
</div>


<button type="submit">S'inscrire</button>
</form>

<p style="margin-top:15px;">
Déjà inscrit ? <a href="/login">Se connecter</a>
</p>
</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    let departmentField = document.getElementById('departmentField');
    if (this.value === 'employee' || this.value === 'admin') {
        departmentField.style.display = 'block';
    } else {
        departmentField.style.display = 'none';
    }
});
</script>

</body>
</html>
