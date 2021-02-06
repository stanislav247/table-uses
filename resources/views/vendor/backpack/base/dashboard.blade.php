@extends(backpack_view('blank'))


@section('content')
  <div id="calendar"></div>



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css" integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js" integrity="sha256-rPPF6R+AH/Gilj2aC00ZAuB2EKmnEjXlEWx5MkAp7bw=" crossorigin="anonymous"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridDay',
      events: '{{route('table.reservations')}}',
      dateClick: function (date) {
            console.log(date);
            let year = date.date.getFullYear();

            let month = date.date.getMonth() + 1;
            month = (month < 10 ? '0' : '') + month;

            let day = date.date.getDate();
            day = (day < 10 ? '0' : '') + day;

            let hour = date.date.getHours();
            hour = (hour < 10 ? '0' : '') + hour;

            let minute = date.date.getMinutes();
            minute = (minute < 10 ? '0' : '') + minute;

            window.location = '{{url('')}}/admin/tableuses/create?from_date='+year+'-'+month+'-'+day+' '+hour+':'+minute;
        },
        eventClick: function (info) {
            console.log(info);
            window.location = '{{url('')}}/admin/tableuses/'+info.event.id+'/edit';
        },

        headerToolbar: {
            center: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
            dayGridMonth: {},
            timeGridWeek: {
                nowIndicator: true,
                slotMinTime:'08:00',
                slotMaxTime:'21:00',
                allDaySlot :false,
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            },
            timeGridDay: {
                nowIndicator: true,
                slotMinTime:'08:00',
                slotMaxTime:'21:00',
                allDaySlot :false,
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            }
        }
    });
    calendar.render();
  });

</script>


  @endsection
