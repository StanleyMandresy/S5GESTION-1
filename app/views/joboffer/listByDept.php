<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres du département | VerdeDesign</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind & DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">
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

        .status-valid {
            color: green;
            font-weight: 600;
        }

        .status-pending {
            color: orange;
            font-weight: 600;
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
    <h2>Offres du département</h2>

    <?php if(empty($offers)): ?>
        <p class="text-center">Aucune offre pour ce département.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Titre</th>
                <th>Lieu</th>
                <th>Date limite</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            <?php foreach($offers as $offer): ?>
            <tr>
                <td data-label="Titre"><?= htmlspecialchars($offer['title']) ?></td>
                <td data-label="Lieu"><?= htmlspecialchars($offer['locations']) ?></td>
                <td data-label="Date limite"><?= $offer['deadline'] ?></td>
                <td data-label="Statut" class="<?= $offer['is_active'] ? 'status-valid' : 'status-pending' ?>">
                    <?= $offer['is_active'] ? "Validée" : "En attente" ?>
                </td>
                <td data-label="Actions">
                    <a href="/offers/edit?id=<?= $offer['id'] ?>">✏️ Modifier</a>
                    <a href="/offers/delete?id=<?= $offer['id'] ?>" onclick="return confirm('Supprimer cette offre ?')">🗑️ Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
