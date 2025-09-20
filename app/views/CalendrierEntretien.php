<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<button><a href="/entretien/formulaire">Planifier un Entretien</a></button>


<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '/entretien/getEntretiens', // ton backend
    selectable: true,
    select: function(info) {
      let date = info.startStr;
      if(confirm("Planifier un entretien le " + date + " ?")) {
        // appel AJAX pour créer entretien
        fetch('/entretien/create', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ date_heure_debut: date, idCandidat: 1 })
        }).then(res => res.json())
          .then(data => {
            calendar.refetchEvents();
          });
      }
    },
    eventClick: function(info) {
      let id = info.event.id;
      let note = prompt("Note :", info.event.extendedProps.note || "");
      let remarque = prompt("Remarque :", "");
      let presence = confirm("Le candidat était présent ?") ? "presents" : "absents";

      fetch('/entretien/update', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id: id, note: note, remarques: remarque, presence: presence })
      }).then(res => res.json())
        .then(data => {
          calendar.refetchEvents();
        });
    }
  });
  calendar.render();
});
</script>
