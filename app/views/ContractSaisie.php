<form method="post" action="/contracts/store">

    <!-- Liste déroulante des candidats reçus -->
    <label for="idCandidatRecu">Candidat reçu :</label>
    <select name="idCandidatRecu" required>
        <option value="">-- Sélectionner un candidat --</option>
        <?php if (isset($candidats) && is_array($candidats)) : ?>
            <?php foreach ($candidats as $candidat) : ?>
                <option value="<?= htmlspecialchars($candidat['id']) ?>">
                    <?= htmlspecialchars($candidat['first_name'] . ' ' . $candidat['last_name']) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select><br>

    <!-- Liste déroulante des types de contrat -->
    <label for="contract_type">Type de contrat :</label>
    <select name="contract_type" required>
        <option value="">-- Sélectionner un type --</option>
        <?php if (isset($typesContrat) && is_array($typesContrat)) : ?>
            <?php foreach ($typesContrat as $type) : ?>
                <option value="<?= htmlspecialchars($type['type_name']) ?>">
                    <?= htmlspecialchars($type['type_name']) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select><br>
    <input type="date" name="start_date" required><br>
    <input type="date" name="end_date"><br>
    <input type="number" name="remuneration" placeholder="Salaire mensuel"><br>

    <!-- Missions -->
    <h4>Missions</h4>
    <textarea name="missions[]"></textarea>
    <textarea name="missions[]"></textarea>

    <!-- Clauses -->
    <h4>Clauses</h4>
    <input type="text" name="clauses[0][title]" placeholder="Titre clause">
    <textarea name="clauses[0][text]"></textarea>

    <input type="text" name="clauses[1][title]" placeholder="Titre clause">
    <textarea name="clauses[1][text]"></textarea>

    <!-- Nouveau type de contrat -->
    <h4>Nouveau type de contrat (optionnel)</h4>
    <input type="text" name="new_contract_type" placeholder="ex: Freelance">

    <button type="submit">Enregistrer</button>
</form>
