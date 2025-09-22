<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendrier des Entretiens</title>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Tailwind + DaisyUI -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.0.0/dist/full.css" rel="stylesheet">

<style>
body {
    background-color: #DCDED6;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 30px;
}

#calendar {
    max-width: 1000px;
    margin: 40px auto;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(93,114,111,0.2);
    padding: 20px;
}
.btn-planifier {
    display: inline-block;
    margin-bottom: 20px;
}
</style>
</head>
<body>

<div class="text-center">
    <a href="/entretien/formulaire" class="btn btn-primary btn-planifier">
        ➕ Planifier un Entretien
    </a>
</div>

<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: '/entretien/getEntretiens',
    selectable: true,
    select: function(info) {
      let date = info.startStr;
      if(confirm("Planifier un entretien le " + date + " ?")) {
        fetch('/entretien/create', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ date_heure_debut: date, idCandidat: 1 })
        })
        .then(res => res.json())
        .then(data => {
          calendar.refetchEvents();
        });
      }
    },
    eventClick: function(info) {
      let id = info.event.id;
      let note = prompt("Note :", info.event.extendedProps.note || "");
      let remarque = prompt("Remarque :", info.event.extendedProps.remarque || "");
      let presence = confirm("Le candidat était présent ?") ? "presents" : "absents";

      fetch('/entretien/update', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id: id, note: note, remarques: remarque, presence: presence })
      })
      .then(res => res.json())
      .then(data => {
        calendar.refetchEvents();
      });
    }
  });
  calendar.render();
});
</script>

</body>
</html>
