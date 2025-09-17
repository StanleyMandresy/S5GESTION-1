<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - QCM Département</title>
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
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #DCDED6 0%, #CED0C3 100%);
            min-height: 100vh;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #5D726F;
            opacity: 0.7;
            border-radius: 0;
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, 15px); }
            100% { transform: translate(0, -0px); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(93, 114, 111, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 20px rgba(93, 114, 111, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(93, 114, 111, 0); }
        }
    </style>
</head>
<body class="py-4 px-2">
    <div id="confetti-container" class="fixed inset-0 z-0 overflow-hidden pointer-events-none"></div>
    
    <div class="container mx-auto max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden relative z-10">
        <div class="p-6 text-center" style="background-color: #5D726F;">
            <div class="flex justify-center mb-3">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-white border-4 border-white floating">
                    <i class="fas fa-folder-open text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Réponses Enregistrées !</h1>
            <p class="text-white opacity-90 text-sm"></p>
        </div>

        <div class="p-6 text-center">
            <div class="relative mb-6">
                <svg class="w-48 h-48 mx-auto" viewBox="0 0 200 200">
                    <circle stroke="#e6e6e6" stroke-width="10" fill="transparent" r="80" cx="100" cy="100"/>
                    <circle stroke="#5D726F" stroke-width="10" fill="transparent" r="80" cx="100" cy="100" stroke-dasharray="502.4" stroke-dashoffset="0"/>
                    <path fill="#5D726F" d="M85,135 L65,115 L72,108 L85,121 L128,78 L135,85 Z"/>
                </svg>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-3" style="color: #5D726F;">Merci d'avoir participé !</h2>
                <p class="text-gray-600 mb-4 text-sm">Vos réponses ont été enregistrées avec succès dans notre système.  </p>
                
                <div class="bg-gray-100 rounded-lg p-3 mb-4">
                    <div class="flex items-center justify-center">
                        <div class="pulse w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-gray-700 text-sm">Traitement en cours...</span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <button class="btn btn-outline px-4 py-2 rounded-full border-darker text-darker hover:bg-darker hover:text-white transition-all text-sm">
                    <i class="fas fa-home mr-1"></i> Retour à l'accueil
                </button>
                <button class="btn px-4 py-2 rounded-full text-white text-sm" style="background-color: #5D726F;">
                    <i class="fas fa-download mr-1"></i> telecharger le reçu
                </button>
            </div>
        </div>
        
        <div class="p-4 text-center bg-gray-100">
            <p class="text-gray-600 text-xs">© 2025 QCM Département. Tous droits réservés.</p>
        </div>
    </div>

    <script>
        function createConfetti() {
            const container = document.getElementById('confetti-container');
            const colors = ['#5D726F', '#859393', '#B4BAB1', '#CED0C3', '#DCDED6'];
            
            for (let i = 0; i < 40; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = -20 + 'px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = (5 + Math.random() * 8) + 'px';
                confetti.style.height = (5 + Math.random() * 8) + 'px';
                confetti.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                
                container.appendChild(confetti);
                
                const animation = confetti.animate([
                    { top: '-20px', transform: 'rotate(0deg)' },
                    { top: '100vh', transform: 'rotate(720deg)' }
                ], {
                    duration: 2000 + Math.random() * 3000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)',
                    delay: Math.random() * 500
                });
                
                animation.onfinish = () => confetti.remove();
            }
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            createConfetti();
            setInterval(createConfetti, 5000);
        });
    </script>
</body>
</html>