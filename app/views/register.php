<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Entreprise Paysagiste</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DaisyUI via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-accent: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark-accent: #859393;
            --color-dark: #5D726F;
        }
        
        body {
            background-color: var(--color-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .register-container {
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(93, 114, 111, 0.2);
            overflow: hidden;
            width: 90%;
            max-width: 1000px;
            display: flex;
            min-height: 600px;
        }
        
        .register-left {
            flex: 1;
            background: linear-gradient(120deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .register-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .register-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
            max-height: 600px;
        }
        
        .logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--color-dark);
        }
        
        .logo span {
            color: var(--color-dark-accent);
        }
        
        .welcome-text {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        
        .welcome-text h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .welcome-text p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .feature-list {
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .feature-icon {
            background-color: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid var(--color-light-accent);
            border-radius: 12px;
            padding: 15px 20px 15px 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--color-dark-accent);
            box-shadow: 0 0 0 0.25rem rgba(133, 147, 147, 0.25);
        }
        
        .form-select {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid var(--color-light-accent);
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%235D726F' viewBox='0 0 16 16'%3E%3Cpath d='M8 12L2 6h12L8 12z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }
        
        .form-select:focus {
            border-color: var(--color-dark-accent);
            box-shadow: 0 0 0 0.25rem rgba(133, 147, 147, 0.25);
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-dark-accent);
            font-size: 1.2rem;
        }
        
        .btn-register {
            background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(93, 114, 111, 0.3);
            margin-top: 10px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--color-dark);
        }
        
        .btn-login {
            color: var(--color-dark-accent);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            color: var(--color-dark);
            text-decoration: underline;
        }
        
        .error-message {
            background-color: rgba(255, 0, 0, 0.1);
            color: #d9534f;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #d9534f;
        }
        
        .decoration-leaf {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
        }
        
        .leaf-1 {
            top: 10%;
            right: -30px;
            font-size: 150px;
            transform: rotate(30deg);
        }
        
        .leaf-2 {
            bottom: 10%;
            left: -30px;
            font-size: 120px;
            transform: rotate(-20deg);
        }
        
        @media (max-width: 992px) {
            .register-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .register-left, .register-right {
                padding: 30px;
            }
            
            .register-right {
                max-height: none;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Partie gauche avec informations -->
        <div class="register-left">
            <i class="fas fa-leaf decoration-leaf leaf-1"></i>
            <i class="fas fa-seedling decoration-leaf leaf-2"></i>
            
            <div class="welcome-text">
                <h2>Rejoignez <span>Verde</span>Design</h2>
                <p>Créez votre compte pour accéder à toutes les fonctionnalités de notre plateforme dédiée aux paysagistes passionnés.</p>
            </div>
            
            <div class="feature-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <p>Gérez vos projets paysagers</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <p>Collaborez avec notre équipe</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <p>Accédez à des ressources exclusives</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <p>Suivez l'avancement de vos demandes</p>
                </div>
            </div>
        </div>
        
        <!-- Partie droite avec formulaire -->
        <div class="register-right">
            
            <h3 class="mb-4">Créer un compte</h3>
            
            <?php if(!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form action="/register" method="POST" autocomplete="off">
                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="first_name" class="form-control" placeholder="Prénom" required autocomplete="off">
                </div>
                
                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="last_name" class="form-control" placeholder="Nom" required autocomplete="off">
                </div>
                
                <div class="form-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autocomplete="new-password">
                </div>
                
                <div class="form-group">
                    <select name="role" id="roleSelect" class="form-select" required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="candidate">Candidat</option>
                        <option value="employee">Employé</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <!-- Champ Département -->
                <div class="form-group" id="departmentField" style="display:none;">
                    <select name="idDepartement" class="form-select">
                        <option value="">-- Sélectionnez un département --</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= htmlspecialchars($dept['id']) ?>">
                                <?= htmlspecialchars($dept['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn-register">S'inscrire</button>
            </form>
            
            <div class="login-link">
                Déjà inscrit ? 
                <a href="/login" class="btn-login">Se connecter</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Afficher/masquer le champ département en fonction du rôle sélectionné
        document.getElementById('roleSelect').addEventListener('change', function() {
            let departmentField = document.getElementById('departmentField');
            if (this.value === 'employee' || this.value === 'admin') {
                departmentField.style.display = 'block';
            } else {
                departmentField.style.display = 'none';
            }
        });
        
        // Animation des champs de formulaire
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach((input, index) => {
                input.style.opacity = '0';
                input.style.transform = 'translateY(10px)';
                input.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                
                setTimeout(() => {
                    input.style.opacity = '1';
                    input.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>