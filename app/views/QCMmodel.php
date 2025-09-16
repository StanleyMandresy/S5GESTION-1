<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCM Département</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#7C3AED',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
        }
        .question-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .question-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -10px rgba(79, 70, 229, 0.3);
        }
        .checkbox-container input[type="checkbox"]:checked + label {
            background-color: #4F46E5;
            color: white;
            border-color: #4F46E5;
        }
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body class="py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <header class="text-center mb-12">
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-graduation-cap text-4xl"></i>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-primary mb-3">Questionnaire à Choix Multiples</h1>
            <p class="text-gray-600 text-lg">Testez vos connaissances avec notre QCM interactif</p>
            
            <!-- Progress bar -->
            <div class="mt-8 bg-gray-200 rounded-full h-3 w-3/4 mx-auto shadow-inner">
                <div class="progress-bar h-3 rounded-full bg-gradient-to-r from-primary to-secondary" style="width: 30%"></div>
            </div>
        </header>

        <!-- QCM Form -->
        <form action="/submit-qcm" method="post" class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
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
                <div class="question-card card bg-base-100 border border-gray-100 mb-8 rounded-2xl overflow-hidden">
                    <div class="card-body p-6">
                        <div class="flex items-start">
                            <div class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center text-primary mr-4 mt-1">
                                <span class="font-bold"><?php echo $question_count; ?></span>
                            </div>
                            <div class="flex-1">
                                <h2 class="card-title text-xl text-gray-800 mb-4">
                                    <i class="fas fa-question-circle text-secondary mr-2"></i>
                                    <?php echo htmlspecialchars($question_data['question_text']); ?>
                                </h2>
                                
                                <div class="space-y-3 mt-5">
                                    <?php foreach ($question_data['options'] as $index => $option) { 
                                        $option_letter = chr(65 + $index); // A, B, C, etc.
                                    ?>
                                    <div class="checkbox-container">
                                        <input type="checkbox" 
                                               name="reponses[<?php echo $question_id; ?>][]" 
                                               value="<?php echo htmlspecialchars($option['option_label']); ?>"
                                               id="q_<?php echo $question_id; ?>_<?php echo htmlspecialchars($option['option_label']); ?>"
                                               class="hidden">
                                        <label for="q_<?php echo $question_id; ?>_<?php echo htmlspecialchars($option['option_label']); ?>" 
                                               class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 hover:border-primary/50 hover:bg-primary/5">
                                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-700 font-bold mr-4">
                                                <?php echo $option_letter; ?>
                                            </span>
                                            <span class="text-gray-700"><?php echo htmlspecialchars($option['option_text']); ?></span>
                                        </label>
                                    </div>
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
            <div class="mt-10 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded-full px-10 shadow-lg transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane mr-2"></i> Soumettre le QCM
                </button>
            </div>
        </form>
        
        <!-- Footer -->
        <footer class="text-center mt-12 text-gray-500 text-sm">
            <p>© 2023 QCM Département. Tous droits réservés.</p>
        </footer>
    </div>

    <script>
        // Animation pour les cases à cocher
        document.querySelectorAll('.checkbox-container label').forEach(label => {
            label.addEventListener('click', function() {
                const checkbox = document.getElementById(this.htmlFor);
                if (checkbox.checked) {
                    this.querySelector('span:first-child').classList.add('bg-primary', 'text-white');
                    this.classList.add('border-primary', 'bg-primary/10');
                } else {
                    this.querySelector('span:first-child').classList.remove('bg-primary', 'text-white');
                    this.classList.remove('border-primary', 'bg-primary/10');
                }
            });
        });

        // Animation de la barre de progression au défilement
        window.addEventListener('scroll', function() {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercentage = (scrollTop / scrollHeight) * 100;
            document.querySelector('.progress-bar').style.width = Math.min(30 + scrollPercentage * 0.7, 100) + '%';
        });
    </script>
</body>
</html>