<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Entretiens - Entreprise de Paysagiste</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Daisy UI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-light: #DCDED6;
            --primary-medium: #CED0C3;
            --primary-dark: #B4BAB1;
            --secondary-light: #859393;
            --secondary-dark: #5D726F;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9fafb;
            color: #333;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: var(--secondary-dark);
        }
        
        .header-gradient {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-medium) 100%);
        }
        
        .calendar-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(93, 114, 111, 0.1);
            overflow: hidden;
        }
        
        .fc-theme-standard .fc-scrollgrid {
            border: none;
        }
        
        .fc-theme-standard td, .fc-theme-standard th {
            border-color: var(--primary-light);
        }
        
        .fc .fc-toolbar-title {
            font-family: 'Playfair Display', serif;
            color: var(--secondary-dark);
            font-weight: 600;
        }
        
        .fc .fc-button {
            background-color: var(--secondary-light);
            border-color: var(--secondary-light);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .fc .fc-button:hover {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
            transform: translateY(-2px);
        }
        
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
        }
        
        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(212, 222, 214, 0.3);
        }
        
        .fc .fc-event {
            background-color: var(--secondary-light);
            border-color: var(--secondary-light);
            border-radius: 6px;
            padding: 3px 6px;
            font-size: 0.85rem;
        }
        
        .fc .fc-event:hover {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--primary-medium) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
            box-shadow: 0 5px 15px rgba(93, 114, 111, 0.2);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .btn-landscaper {
            background: linear-gradient(135deg, var(--secondary-light) 0%, var(--secondary-dark) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(93, 114, 111, 0.3);
        }
        
        .btn-landscaper:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(93, 114, 111, 0.4);
            color: white;
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 40px rgba(93, 114, 111, 0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-medium) 100%);
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 20px 25px;
        }
        
        .modal-title {
            color: var(--secondary-dark);
            font-weight: 600;
        }
        
        .footer-section {
            background-color: var(--secondary-dark);
            color: white;
        }
        
        .event-status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 5px;
        }
        
        .status-planned {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .status-completed {
            background-color: #e8f5e9;
            color: #388e3c;
        }
        
        .status-cancelled {
            background-color: #ffebee;
            color: #d32f2f;
        }
        
        .quick-action-btn {
            background-color: white;
            border: 2px solid var(--primary-medium);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .quick-action-btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(93, 114, 111, 0.1);
        }
        
        .quick-action-btn i {
            color: var(--secondary-dark);
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header-gradient py-4 shadow-md">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold mb-0">
                        <i class="fas fa-leaf me-2"></i>VertDesign Paysage
                    </h1>
                    <p class="mb-0 text-muted">Calendrier des entretiens</p>
                </div>
                <div class="col-md-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-landscaper dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>Administrateur
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <!-- Stats Section -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-calendar-check fa-2x mb-3"></i>
                        <h3 class="mb-1">12</h3>
                        <p class="mb-0">Entretiens ce mois</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-user-check fa-2x mb-3"></i>
                        <h3 class="mb-1">8</h3>
                        <p class="mb-0">Présences confirmées</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-clock fa-2x mb-3"></i>
                        <h3 class="mb-1">3</h3>
                        <p class="mb-0">Entretiens à venir</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-chart-line fa-2x mb-3"></i>
                        <h3 class="mb-1">75%</h3>
                        <p class="mb-0">Taux de présence</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="mb-4">Actions rapides</h2>
                    <div class="d-flex flex-wrap gap-3">
                     <a href="/entretien/formulaire">   <div class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#addInterviewModal">
                            <i class="fas fa-plus-circle"></i>
                           <p class="mb-0 fw-bold">Nouvel entretien</p>
                        </div></a> 
                        <div class="quick-action-btn" onclick="exportCalendar()">
                            <i class="fas fa-file-export"></i>
                            <p class="mb-0 fw-bold">Exporter</p>
                        </div>
                        <div class="quick-action-btn" onclick="filterCalendar('today')">
                            <i class="fas fa-calendar-day"></i>
                            <p class="mb-0 fw-bold">Aujourd'hui</p>
                        </div>
                        <div class="quick-action-btn" onclick="filterCalendar('week')">
                            <i class="fas fa-calendar-week"></i>
                            <p class="mb-0 fw-bold">Cette semaine</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="row">
                <div class="col-12">
                    <div class="calendar-container p-4">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-section py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-leaf me-2"></i>VertDesign Paysage</h5>
                    <p class="mb-0">Créateurs d'espaces verts exceptionnels depuis 2005</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">© 2023 VertDesign Paysage. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Add Interview Modal -->
    <div class="modal fade" id="addInterviewModal" tabindex="-1" aria-labelledby="addInterviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInterviewModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Planifier un nouvel entretien
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="interviewForm">
                        <div class="mb-3">
                            <label for="candidateName" class="form-label">Nom du candidat</label>
                            <input type="text" class="form-control" id="candidateName" placeholder="Entrez le nom du candidat">
                        </div>
                        <div class="mb-3">
                            <label for="interviewDate" class="form-label">Date et heure</label>
                            <input type="datetime-local" class="form-control" id="interviewDate">
                        </div>
                        <div class="mb-3">
                            <label for="interviewType" class="form-label">Type d'entretien</label>
                            <select class="form-select" id="interviewType">
                                <option value="technique">Technique</option>
                                <option value="rh">Ressources Humaines</option>
                                <option value="mixte">Mixte</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="interviewNotes" class="form-label">Notes préliminaires</label>
                            <textarea class="form-control" id="interviewNotes" rows="3" placeholder="Notes ou informations importantes..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-landscaper" onclick="submitInterviewForm()">
                        <i class="fas fa-save me-2"></i>Planifier l'entretien
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/entretien/getEntretiens',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventDidMount: function(info) {
                    // Ajouter un badge de statut selon l'état de l'événement
                    const status = info.event.extendedProps.status || 'planned';
                    let statusBadge = document.createElement('span');
                    statusBadge.classList.add('event-status-badge');

                    if (status === 'completed') {
                        statusBadge.classList.add('status-completed');
                        statusBadge.textContent = 'Terminé';
                    } else if (status === 'cancelled') {
                        statusBadge.classList.add('status-cancelled');
                        statusBadge.textContent = 'Annulé';
                    } else {
                        statusBadge.classList.add('status-planned');
                        statusBadge.textContent = 'Planifié';
                    }

                    info.el.querySelector('.fc-event-title').appendChild(statusBadge);
                },
                select: function(info) {
                    let date = info.startStr;
                    let formattedDate = new Date(date).toLocaleDateString('fr-FR', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    // Afficher un modal au lieu d'une alerte simple
                    document.getElementById('interviewDate').value = date.substring(0, 16);
                    let modal = new bootstrap.Modal(document.getElementById('addInterviewModal'));
                    modal.show();
                },
                eventClick: function(info) {
                    let id = info.event.id;
                    let title = info.event.title;
                    let start = info.event.start;

                    if (info.event.extendedProps.presence === 'presents') {
                        showNotification("Candidat déjà présent : modification interdite", "info");
                        return;
                    }
                    // Créer un modal personnalisé pour modifier l'entretien
                    let modalContent = `
                        <div class="mb-3">
                            <h5>Modifier l'entretien avec ${title}</h5>
                            <p class="text-muted">${start.toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                        </div>
                        <div class="mb-3">
                            <label for="editNote" class="form-label">Note</label>
                            <input type="text" class="form-control" id="editNote" value="${info.event.extendedProps.note || ''}">
                        </div>
                        <div class="mb-3">
                            <label for="editRemarque" class="form-label">Remarque</label>
                            <textarea class="form-control" id="editRemarque" rows="3">${info.event.extendedProps.remarques || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Présence</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="editPresence" id="editPresent" value="presents" ${info.event.extendedProps.presence === 'presents' ? 'checked' : ''}>
                                    <label class="form-check-label" for="editPresent">Présent</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="editPresence" id="editAbsent" value="absents" ${info.event.extendedProps.presence === 'absents' ? 'checked' : ''}>
                                    <label class="form-check-label" for="editAbsent">Absent</label>
                                </div>
                            </div>
                        </div>
                    `;

                    // Utiliser SweetAlert2 pour un modal plus esthétique (à intégrer si disponible)
                    // Pour l'instant, nous utilisons l'approche native
                    let note = prompt("Note :", info.event.extendedProps.note || "");
                    let remarque = prompt("Remarque :", info.event.extendedProps.remarques || "");
                    let presence = confirm("Le candidat était présent ?") ? "presents" : "absents";

                    if (note !== null || remarque !== null) {
                        fetch('/entretien/update', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({
                                id: id,
                                note: note,
                                remarques: remarque,
                                presence: presence
                            })
                        }).then(res => res.json())
                        .then(data => {
                            calendar.refetchEvents();
                            showNotification('Entretien mis à jour avec succès', 'success');
                        });
                    }
                }
            });
            calendar.render();

            // Fonction pour filtrer le calendrier
            window.filterCalendar = function(filter) {
                if (filter === 'today') {
                    calendar.today();
                } else if (filter === 'week') {
                    calendar.changeView('timeGridWeek');
                }
            };

            // Fonction pour exporter le calendrier
            window.exportCalendar = function() {
                // Simuler l'exportation
                showNotification('Exportation du calendrier en cours...', 'info');
                setTimeout(() => {
                    showNotification('Calendrier exporté avec succès!', 'success');
                }, 1500);
            };

            // Fonction pour soumettre le formulaire d'entretien
            window.submitInterviewForm = function() {
                const candidateName = document.getElementById('candidateName').value;
                const interviewDate = document.getElementById('interviewDate').value;
                const interviewType = document.getElementById('interviewType').value;
                const interviewNotes = document.getElementById('interviewNotes').value;

                if (!candidateName || !interviewDate) {
                    showNotification('Veuillez remplir tous les champs obligatoires', 'error');
                    return;
                }

                // Simuler l'envoi des données
                fetch('/entretien/create', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        date_heure_debut: interviewDate,
                        idCandidat: 1, // À remplacer par l'ID réel
                        candidateName: candidateName,
                        type: interviewType,
                        notes: interviewNotes
                    })
                }).then(res => res.json())
                .then(data => {
                    calendar.refetchEvents();
                    bootstrap.Modal.getInstance(document.getElementById('addInterviewModal')).hide();
                    showNotification('Entretien planifié avec succès!', 'success');
                    document.getElementById('interviewForm').reset();
                });
            };

            // Fonction pour afficher les notifications
            function showNotification(message, type) {
                // Créer une notification toast personnalisée
                const toast = document.createElement('div');
                toast.classList.add('position-fixed', 'top-0', 'end-0', 'p-3');
                toast.style.zIndex = '9999';

                let bgColor = 'bg-primary';
                if (type === 'success') bgColor = 'bg-success';
                if (type === 'error') bgColor = 'bg-danger';
                if (type === 'info') bgColor = 'bg-info';

                toast.innerHTML = `
                    <div class="toast align-items-center text-white ${bgColor} border-0 show" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `;

                document.body.appendChild(toast);

                // Supprimer la notification après 3 secondes
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 3000);
            }
        });
    </script>
</body>
</html>
