<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des candidats | VerdeDesign</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-light: #DCDED6;
            --color-light-accent: #CED0C3;
            --color-dark-accent: #859393;
            --color-dark: #5D726F;
        }

        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            color: var(--color-dark);
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(93, 114, 111, 0.2);
            overflow: hidden;
        }

        table th, table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-action {
            min-width: 120px;
        }
    </style>
</head>
<body>
    <h1>Liste des candidats</h1>

    <div class="table-container p-6">
        <table class="table w-full border-collapse border border-gray-300">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="py-3 px-4">Nom</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidats as $candidat): ?>
                <tr class="hover:bg-gray-100 transition-colors">
                    <td class="py-3 px-4"><?= htmlspecialchars($candidat['Nom']) ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($candidat['Mail']) ?></td>
                    <td class="py-3 px-4 flex justify-center gap-2">
                        <!-- Formulaire pour acceptation -->
                        <form method="post" action="/Notification">
                            <input type="hidden" name="idCandidat" value="<?= $candidat['id'] ?>">
                            <input type="hidden" name="idType" value="acceptation">
                            <button type="submit" class="btn btn-success btn-action">
                                <i class="fas fa-check me-1"></i> Acceptation
                            </button>
                        </form>

                        <!-- Formulaire pour rejet -->
                        <form method="post" action="/Notification">
                            <input type="hidden" name="idCandidat" value="<?= $candidat['id'] ?>">
                            <input type="hidden" name="idType" value="rejet">
                            <button type="submit" class="btn btn-error btn-action">
                                <i class="fas fa-times me-1"></i> Rejet
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
