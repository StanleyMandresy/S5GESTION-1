<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e8f5e9; /* vert très clair */
    padding: 20px;
}

/* Table */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

.table thead {
    background-color: #4caf50; /* vert */
    color: white;
    text-align: left;
    position: sticky;
    top: 0;
    z-index: 1;
}

.table th, .table td {
    padding: 12px 15px;
}

/* Lignes impaires */
.table tbody tr:nth-child(odd) {
    background-color: #f1f8f3; /* vert très pâle */
}

/* Lignes au survol */
.table tbody tr:hover {
    background-color: #c8e6c9; /* vert clair */
    transition: 0.3s;
}

/* Moyenne en gras */
.table td strong {
    color: #2e7d32;
}

/* Bouton trier */
.btn-trier {
    background-color: #4caf50;
    color: white;
    font-weight: bold;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}
.btn-trier:hover:not(:disabled) {
    background-color: #388e3c;
}
.btn-trier:disabled {
    background-color: #a5d6a7;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 768px) {
    .table thead {
        display: none;
    }
    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }
    .table tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #4caf50;
    }
    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        padding-left: 10px;
        font-weight: bold;
        text-align: left;
    }
}
</style>

<?php if (!empty($_SESSION['flash'])): ?>
<div class="alert alert-success" style="
background-color:#c8e6c9;
border:1px solid #2e7d32;
color:#2e7d32;
padding:10px;
margin-bottom:15px;
border-radius:6px;
">
<?= htmlspecialchars($_SESSION['flash']) ?>
</div>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<h2>Liste des candidats (Stade 4)</h2>

<!-- Bouton Trier -->
<form action="/offers/result" method="POST" style="margin-bottom:15px;">
<button type="submit"
class="btn-trier"
<?= isset($_SESSION['tri_done']) && $_SESSION['tri_done'] ? 'disabled' : '' ?>>
⚡ Trier & Avancer
</button>
</form>

<!-- Tableau -->
<table class="table">
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Total Points</th>
<th>Note QCM</th>
<th>Note RH</th>
<th>Moyenne</th>
</tr>
</thead>
<tbody>
<?php foreach ($candidats as $c): ?>
<tr>
<td data-label="Nom"><?= htmlspecialchars($c['Nom']) ?></td>
<td data-label="Prénom"><?= htmlspecialchars($c['Prenom']) ?></td>
<td data-label="Total Points"><?= $c['totalPoints'] ?? '-' ?></td>
<td data-label="Note QCM"><?= $c['Notes'] ?? '-' ?></td>
<td data-label="Note RH"><?= $c['NotesRH'] ?? '-' ?></td>
<td data-label="Moyenne"><strong><?= $c['moyenne'] ?? '-' ?></strong></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
