<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM</title>
</head>
<body>
    <h1>QCM pour le département</h1>
    <form action="/submit-qcm" method="post">
        <?php
        
        $questions = [];
        foreach ($QCMmodel as $row) {
            $question_id = $row['question_id'];
            if (!isset($questions[$question_id])) {
                $questions[$question_id] = [
                    'question_text' => $row['question_text'],
                    'options' => []
                ];
            }
            $questions[$question_id]['options'][] = $row;
        }

        // On affiche les questions et leurs options
        foreach ($questions as $question_id => $question_data) {
            ?>
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
                <p><strong>Question : </strong><?php echo htmlspecialchars($question_data['question_text']); ?></p>
                
                <?php foreach ($question_data['options'] as $option) { ?>
                    <div>
                        <input type="checkbox" 
                               name="reponses[<?php echo $question_id; ?>][]" 
                               value="<?php echo htmlspecialchars($option['option_label']); ?>"
                               id="q_<?php echo $question_id; ?>_<?php echo htmlspecialchars($option['option_label']); ?>">
                        <label for="q_<?php echo $question_id; ?>_<?php echo htmlspecialchars($option['option_label']); ?>">
                            <?php echo htmlspecialchars($option['option_text']); ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
        ?>
        <button type="submit">Soumettre le QCM</button>
    </form>
</body>
</html>