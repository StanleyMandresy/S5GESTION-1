<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des offres d'emploi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f7f9;
            color: #333;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f7fd;
        }
        .status-pending {
            color: #e67e22;
            font-weight: bold;
        }
        .status-validated {
            color: #27ae60;
            font-weight: bold;
        }
        .status-rejected {
            color: #e74c3c;
            font-weight: bold;
        }
        .action-form {
            display: inline-block;
            margin-right: 5px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-validate {
            background-color: #2ecc71;
            color: white;
        }
        .btn-validate:hover {
            background-color: #27ae60;
        }
        .btn-reject {
            background-color: #e74c3c;
            color: white;
        }
        .btn-reject:hover {
            background-color: #c0392b;
        }
        .no-offers {
            text-align: center;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #7f8c8d;
        }
        .notification {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<h2>Validation des offres (RH)</h2>

<!-- Zone de notification -->
<div id="notification" class="notification" style="display: none;"></div>

<?php if(empty($offers)): ?>
<div class="no-offers">
<p>Aucune offre à valider.</p>
</div>
<?php else: ?>
<table>
<thead>
<tr>
<th>Titre</th>
<th>Lieu</th>
<th>Date limite</th>
<th>Statut</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($offers as $offer): ?>
<tr>
<td><?= htmlspecialchars($offer['title']) ?></td>
<td><?= htmlspecialchars($offer['locations']) ?></td>
<td><?= $offer['deadline'] ?></td>
<td>
<?php if($offer['is_approved'] == 1): ?>
<span class="status-validated">Validée</span>
<?php elseif($offer['is_approved'] == 0): ?>
<span class="status-pending">En attente</span>
<?php else: ?>
<span class="status-rejected">Refusée</span>
<?php endif; ?>
</td>
<td>
<!-- Formulaire pour valider -->
<form class="action-form" action="/offers/validate" method="post">
<input type="hidden" name="id" value="<?= $offer['id'] ?>">
<input type="hidden" name="status" value="1">
<button type="submit" class="btn btn-validate">Valider</button>
</form>

<!-- Formulaire pour refuser -->
<form class="action-form" action="/offers/validate" method="post">
<input type="hidden" name="id" value="<?= $offer['id'] ?>">
<input type="hidden" name="status" value="0">
<button type="submit" class="btn btn-reject">Refuser</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>


<script>
function showNotification(message, type) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = 'notification ' + type;
    notification.style.display = 'block';

    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000);
}

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('validation')) {
    const status = urlParams.get('validation');
    if (status === 'success') {
        showNotification('Offre validée avec succès!', 'success');
    } else if (status === 'error') {
        showNotification('Erreur lors de la validation de l\'offre.', 'error');
    }
}
</script>
</body>
