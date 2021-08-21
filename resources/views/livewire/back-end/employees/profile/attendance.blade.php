<div>
	<div class="card card-outline card-sayang">
        <div class="card-header">
            <h4 class="card-title">Attendance</h4>
			<div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
            <input type="hidden" id="data" value='@json($data)'>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
  
        /* initialize the calendar
        -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
  
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendarInteraction.Draggable;

        var calendarEl = document.getElementById('calendar');
    
        // initialize the external events
        // -----------------------------------------------------------------
    
        let collection = [];
        @foreach ($data as $item)
            collection.push({
                title          : '{{$item->type}}',
                start          : '{{date("Y-m-d", strtotime($item->created_at))}}',
                backgroundColor: '#28a745', //red
                borderColor    : '#28a745', //red
                allDay         : true
            })
        @endforeach
        
        console.log(collection);
        
        var calendar = new Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            'themeSystem': 'bootstrap',
            //Random default events
            events    : collection
        });
  
      calendar.render();
    })
  </script>
@endpush
