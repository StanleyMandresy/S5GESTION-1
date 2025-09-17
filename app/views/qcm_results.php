<!DOCTYPE html>
<html>
<head>
    <title>Résultats du QCM</title>
    <style>
        .correct { color: green; }
        .incorrect { color: red; }
        .question { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Résultats de votre QCM</h1>
    
    <div class="score">
        <h2>Score: <?php echo $score; ?>/<?php echo $max_score; ?> 
            (<?php echo $percentage; ?>%)</h2>
    </div>
    
    <?php foreach ($questions as $question): ?>
    <div class="question">
        <h3><?php echo $question['question_text']; ?></h3>
        <p>Points: <?php echo $question['points']; ?></p>
        <p>Score obtenu: <?php echo $question['score']; ?></p>
        <p>Statut: 
            <span class="<?php echo $question['is_correct'] ? 'correct' : 'incorrect'; ?>">
                <?php echo $question['is_correct'] ? '✓ Correct' : '✗ Incorrect'; ?>
            </span>
        </p>
        
        <h4>Réponses correctes:</h4>
        <ul>
            <?php foreach ($question['options'] as $option): ?>
                <?php if ($option['is_correct']): ?>
                    <li><strong><?php echo $option['label']; ?>:</strong> 
                        <?php echo $option['text']; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        
        <h4>Vos réponses:</h4>
        <ul>
            <?php if (!empty($question['candidate_choices'])): ?>
                <?php foreach ($question['options'] as $option): ?>
                    <?php if (in_array($option['option_id'], $question['candidate_choices'])): ?>
                        <li class="<?php echo $option['is_correct'] ? 'correct' : 'incorrect'; ?>">
                            <strong><?php echo $option['label']; ?>:</strong> 
                            <?php echo $option['text']; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune réponse</li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</body>
</html>