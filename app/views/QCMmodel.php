<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCM Département</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        light: '#DCDED6',
                        lightAlt: '#CED0C3',
                        medium: '#B4BAB1',
                        dark: '#859393',
                        darker: '#5D726F',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        :root {
            --color-light: #DCDED6;
            --color-light-alt: #CED0C3;
            --color-medium: #B4BAB1;
            --color-dark: #859393;
            --color-darker: #5D726F;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--color-light) 0%, var(--color-light-alt) 100%);
            min-height: 100vh;
        }
        
        .header-icon {
            color: var(--color-darker);
            background-color: var(--color-light-alt);
            border: 3px solid var(--color-dark);
        }
        
        .option-card {
            transition: all 0.3s ease;
        }
        
        .option-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        input[type="checkbox"]:checked + div {
            border-color: var(--color-darker);
            background-color: rgba(93, 114, 111, 0.1);
        }
        
        input[type="checkbox"]:checked + div .option-indicator {
            background-color: var(--color-darker);
            color: white;
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background-color: var(--color-darker);
            transition: width 0.5s ease;
        }
    </style>
</head>
<body class="py-8 px-4">
    <div class="container mx-auto max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- En-tête -->
        <div class="p-8 text-center" style="background-color: #5D726F;">
            <div class="flex justify-center mb-4">
                <div class="header-icon w-20 h-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-4xl"></i>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">QCM Département</h1>
            <p class="text-white opacity-90">Testez vos connaissances avec notre QCM interactif</p>
            
            <!-- Barre de progression -->
            <div class="mt-6 w-full bg-white bg-opacity-20 rounded-full h-2.5">
                <div class="progress-bar bg-white h-2.5 rounded-full transition-all duration-500" id="progress-bar" style="width: 0%"></div>
            </div>
            <p class="text-white text-sm mt-2"><span id="progress-text">0</span>% complété</p>
        </div>

        <!-- QCM Form -->
        <form action="/EnregistrerReponse" method="post" class="p-8">
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
            $question_count = 1;
            foreach ($questions as $question_id => $question_data) {
                ?>
                <div class="question-card card bg-base-100 shadow-md mb-6">
                    <div class="card-body">
                        <div class="flex items-start">
                            <div class="mr-4 mt-1 flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white" style="background-color: #859393;">
                                    <span class="font-bold"><?php echo $question_count; ?></span>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h2 class="card-title text-xl mb-4" style="color: #5D726F;">
                                    <?php echo htmlspecialchars($question_data['question_text']); ?>
                                </h2>
                                
                                <div class="options grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <?php foreach ($question_data['options'] as $index => $option) { 
                                        $option_letter = chr(65 + $index);
                                    ?>
                                    <label class="option-card cursor-pointer">
                                        <input type="checkbox" 
                                               name="reponses[<?php echo $question_id; ?>][]" 
                                               value="<?php echo htmlspecialchars($option['option_id']); ?>"
                                               id="q_<?php echo $question_id; ?>_<?php echo htmlspecialchars($option['option_id']); ?>"
                                               class="hidden peer">
                                        <div class="card bg-base-100 border-2 border-gray-200 h-full">
                                            <div class="card-body py-4">
                                                <div class="flex items-center">
                                                    <div class="option-indicator mr-3 w-8 h-8 rounded-full flex items-center justify-center bg-gray-100">
                                                        <span class="font-bold"><?php echo $option_letter; ?></span>
                                                    </div>
                                                    <span class="text-gray-700"><?php echo htmlspecialchars($option['option_text']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $question_count++;
            }
            ?>
            
            <!-- Submit button -->
            <div class="text-center">
                <button type="submit" class="btn btn-lg text-white border-0 px-8 py-3 text-lg font-semibold rounded-full transition-all duration-300 transform hover:scale-105" style="background-color: #5D726F;">
                    <i class="fas fa-paper-plane mr-2"></i> Soumettre le QCM
                </button>
            </div>
        </form>
    </div>

    <script>
        // Mettre à jour la barre de progression
        function updateProgress() {
            const totalQuestions = document.querySelectorAll('.question-card').length;
            let answered = 0;
            
            document.querySelectorAll('.question-card').forEach(question => {
                const selectedOption = question.querySelector('input:checked');
                if (selectedOption) {
                    answered++;
                }
            });
            
            const percentage = Math.round((answered / totalQuestions) * 100);
            document.getElementById('progress-bar').style.width = `${percentage}%`;
            document.getElementById('progress-text').textContent = percentage;
        }
        
        // Écouter les changements sur les inputs checkbox
        document.querySelectorAll('input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', updateProgress);
        });
        
        // Animation pour les cases à cocher
        document.querySelectorAll('.option-card').forEach(card => {
            card.addEventListener('click', function() {
                const checkbox = this.querySelector('input[type="checkbox"]');
                const indicator = this.querySelector('.option-indicator');
                
                if (checkbox.checked) {
                    indicator.classList.add('bg-darker', 'text-white');
                } else {
                    indicator.classList.remove('bg-darker', 'text-white');
                }
            });
        });
        
        // Initialiser la barre de progression
        document.addEventListener('DOMContentLoaded', updateProgress);
    </script>
</body>
</html>