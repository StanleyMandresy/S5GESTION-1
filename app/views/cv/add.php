<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un CV | VerdeDesign</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DaisyUI via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
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
        }

        .form-container {
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(93, 114, 111, 0.2);
            padding: 40px;
            width: 90%;
            max-width: 800px;
        }

        .form-container h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            color: var(--color-dark);
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input,
        .form-group textarea {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid var(--color-light-accent);
            border-radius: 12px;
            padding: 12px 15px 12px 45px;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--color-dark-accent);
            box-shadow: 0 0 0 0.25rem rgba(133, 147, 147, 0.25);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-dark-accent);
            font-size: 1.2rem;
        }

        .btn-submit {
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
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Ajouter un CV</h2>
    <form method="POST" action="/cv" autocomplete="off">
        <div class="form-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" name="nom" placeholder="Nom" required>
        </div>

        <div class="form-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" name="prenom" placeholder="Prénom" required>
        </div>

        <div class="form-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <i class="fas fa-briefcase input-icon"></i>
            <input type="text" name="titre_poste" placeholder="Titre recherché" required>
        </div>

        <div class="form-group">
            <i class="fas fa-file-alt input-icon"></i>
            <textarea name="description" placeholder="Description"></textarea>
        </div>

        <div class="form-group">
            <i class="fas fa-lightbulb input-icon"></i>
            <textarea name="skills" placeholder="Compétences"></textarea>
        </div>

        <div class="form-group">
            <i class="fas fa-map-marker-alt input-icon"></i>
            <input type="text" name="location" placeholder="Lieu" required>
        </div>

        <div class="form-group">
            <i class="fas fa-calendar-alt input-icon"></i>
            <input type="date" name="date_depot" required>
        </div>

        <button type="submit" class="btn-submit">Enregistrer</button>
    </form>
</div>

</body>
</html>
