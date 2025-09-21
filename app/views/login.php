<link rel="stylesheet" href="/assets/css/login.css">

<div class="container">
    <h1>Connexion</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="/login" method="POST" autocomplete="off">
        <input type="email" name="email" placeholder="Email" required autocomplete="off">
        <input type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
        <button type="submit" class="btn">Se connecter</button>
    </form>

    <p>
        Pas encore de compte ? 
        <a href="/register" class="btn btn-register">S'inscrire</a>
    </p>
</div>
