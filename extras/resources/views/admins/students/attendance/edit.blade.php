@extends('studentform',['student'=>$student])

@section('section')
{!! form_start($form) !!}
 <input type="hidden" name="_method" value="put">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
{!! form_row($form->type) !!}
{!! form_row($form->slot) !!}
@include('partials.notifications')
<div class="form-group">
  <label for="Marked_On">Attendance On</label>
                <div class='input-group date' >
                    <input type='text' id='datetimepicker1' class="form-control" name="attendance_on" value="{{$attendance->attendance_on}}" required/>
                    <span class="input-group-addon" id="btn1">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>
  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  <a class="btn btn-labeled btn-default" href="{{URL::previous()}}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}


<script>
$(document).ready(function(){
  $.when(
      $.getScript('{{ URL::asset("js/jquery.js")}}'),
    $.getScript('{{ URL::asset("js/jquery-ui.js")}}'),
      $.Deferred(function( deferred ){
          $( deferred.resolve );
      })
  ).done(function(){


     $('#btn1').click(function(){
       $('#datetimepicker1').datepicker({
         dateFormat:'dd/mm/yy'
       }).focus();
     });


  });

});

</script>

@endsection
