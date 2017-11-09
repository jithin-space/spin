@extends('student_layout1',['student'=>$student])

@section('section')

<div id="calendar"></div>


<div class="container">
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Attendance</h4>
        </div>
        <div class="modal-body" id="out1">
          <h4> You Do Not Have the Permission For this Action </h4>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>



<script>
$(document).ready(function() {
$.when(
  $.getScript('{{ URL::asset("js/moment.js")}}'),
  $.getScript( '{{ URL::asset("js/bootstrap.min.js")}}' ),
  $.getScript( '{{ URL::asset("js/datetimepicker.js")}}'),
    $.getScript( '{{ URL::asset("assets/fullcalendar/fullcalendar.min.js")}}'),
    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){


  $('#calendar').fullCalendar({
    header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
      defaultDate: Date.now(),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
      eventBorderColor:'blue',
      eventBackgroundColor:'blue',
			axisFormat: 'h:mm', // uppercase H for 24-hour clock
			timeFormat: 'H:mm',
			snapOnSlots: {
				snapEffectiveDuration: false, // default: false
				snapPolicy: 'enlarge'         // default: 'enlarge', could also be 'closest'
			},
			slots: [
				{start: '10:00', end: '11:30'},
				{start: '11:30', end: '13:00'},
				{start: '14:00', end: '15:30'},
				{start: '15:30', end: '17:00'},

			],
			events: [
          <?php


          foreach($student->attendances as $attendance)
          {
          $date1 = DateTime::createFromFormat('d/m/Y', $attendance->attendance_on);
          $date2= DateTime::createFromFormat('d/m/Y', $attendance->attendance_on);

          $url= route("students.attendance.show",[\Auth::user()->roles()->first()->name,$student->_id,$attendance->_id]);
            if($attendance->type=="Regular")
            {
            switch($attendance->slot){
              case "slot1": $start=$date1->setTime(10,00);
                            $end=$date2->setTime(11,30);
                            break;

              case "slot2": $start=$date1->setTime(11,30);
                            $end=$date2->setTime(13,00);
                            break;
              case "slot3": $start=$date1->setTime(14,00);
                            $end=$date2->setTime(15,30);
                            break;
              case "slot4": $start=$date1->setTime(15,30);
                            $end=$date2->setTime(17,00);
                            break;
            }
            echo "  {
                title:'{$attendance->type}',
                start:'{$start->format("Y-m-d H:i:s")}',
                end:'{$end->format("Y-m-d H:i:s")}',
                color:'Chocolate',
                'test':'{$url}'
              },
              ";
            }
            else
            {
            switch($attendance->slot){
              case "slot1": $start=$date1->setTime(11,00);
                            $end=$date2->setTime(11,30);
                            break;
              case "slot2":$start=$date1->setTime(12,30);
                            $end=$date2->setTime(13,00);
                            break;
              case "slot3": $start=$date1->setTime(15,00);
                            $end=$date2->setTime(15,30);
                            break;
              case "slot4": $start=$date1->setTime(16,30);
                            $end=$date2->setTime(17,00);
                            break;
            }

            echo "  {
                title:'{$attendance->type}',
                start:'{$start->format("Y-m-d H:i:s")}',
                end:'{$end->format("Y-m-d H:i:s")}',
                color:'green',
                test:'{$url}'
              },
              ";
            }


          }
            ?>
          ],
    dayClick: function(date, jsEvent, view) {
          var xhttp;
          var ajaxurl = '{{route("students.attendance.create",[\Auth::user()->roles()->first()->name,$student->_id])}}';
          xhttp=new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("out1").innerHTML = xhttp.responseText;
              $('#datetimepicker1').datetimepicker({
                       format: 'DD/MM/YYYY',
                       defaultDate: date,
              });

            }
          };
          xhttp.open("GET",ajaxurl, true);
          xhttp.send();
        $('#myModal1').modal({
       show: 'true',
        });


    },

    eventClick: function(calEvent, jsEvent, view) {
        var xhttp;
        var ajaxurl = calEvent.test;
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("out1").innerHTML = xhttp.responseText;
          }
        };
        xhttp.open("GET",ajaxurl, true);
        xhttp.send();
        $('#myModal1').modal({
       show: 'true',
        });
        // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        // alert('View: ' + view.name);
        //
        // // change the border color just for fun
        // $(this).css('border-color', 'red');

    },


  });

});

});

</script>
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
@endsection
