<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Offres | VerdeDesign</title>
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
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(93, 114, 111, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: var(--color-dark);
            font-size: 2rem;
        }

        a.add-offer {
            display: inline-block;
            margin-bottom: 20px;
            background: linear-gradient(90deg, var(--color-dark) 0%, var(--color-dark-accent) 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a.add-offer:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 114, 111, 0.4);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--color-light-accent);
        }

        th {
            background-color: var(--color-dark);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        tr:hover {
            background-color: rgba(133,147,147,0.1);
        }

        td a {
            margin-right: 10px;
            color: var(--color-dark-accent);
            font-weight: 600;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            table, th, td {
                display: block;
            }
            th {
                display: none;
            }
            tr {
                margin-bottom: 20px;
                border-bottom: 2px solid var(--color-light-accent);
            }
            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--color-dark);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Liste des Offres</h2>
    <a href="/addjob" class="add-offer">➕ Ajouter une offre</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Département</th>
            <th>Lieu</th>
            <th>Date limite</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($offers as $offer): ?>
            <tr>
                <td data-label="ID"><?= $offer['id'] ?></td>
                <td data-label="Titre"><?= htmlspecialchars($offer['title']) ?></td>
                <td data-label="Département"><?= htmlspecialchars($offer['department_name']) ?></td>
                <td data-label="Lieu"><?= htmlspecialchars($offer['locations']) ?></td>
                <td data-label="Date limite"><?= $offer['deadline'] ?></td>
                <td data-label="Actions">
                    <a href="/job/<?= $offer['id'] ?>">👁 Voir</a>
                    <a href="/apply/<?= $offer['id'] ?>">Postuler</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
