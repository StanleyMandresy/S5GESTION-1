<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes CV | VerdeDesign</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DaisyUI -->
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 40px;
        }

        .page-container {
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(93, 114, 111, 0.2);
            padding: 30px;
        }

        h2 {
            font-size: 2rem;
            color: var(--color-dark);
            margin-bottom: 25px;
        }

        .btn-addcv {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            border-radius: 12px;
            background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-addcv:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255,255,255,0.8);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--color-light-accent);
        }

        th {
            background-color: var(--color-dark-accent);
            color: white;
        }

        tr:hover {
            background-color: rgba(181, 186, 177, 0.3);
        }
    </style>
</head>
<body>

<div class="page-container">
    <h2>Mes CV</h2>
    <a href="/addcv" class="btn-addcv"><i class="fas fa-plus me-2"></i>Ajouter un CV</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Titre recherché</th>
                <th>Compétences</th>
                <th>Date de dépôt</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cvs as $cv): ?>
                <tr>
                    <td><?= htmlspecialchars($cv['id']) ?></td>
                    <td><?= htmlspecialchars($cv['nom'] . " " . $cv['prenom']) ?></td>
                    <td><?= htmlspecialchars($cv['titre_poste']) ?></td>
                    <td><?= htmlspecialchars($cv['skills']) ?></td>
                    <td><?= htmlspecialchars($cv['date_depot']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
