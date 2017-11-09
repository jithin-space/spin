@extends('studentform',['student'=>$student])
@section('page_heading', 'Other Services Information')
@section('section')

{!! form_start($form) !!}
  {!! form_row($form->service_category) !!}
  {!! form_row($form->service_type) !!}
  {!! form_row($form->service_status) !!}


<div class="form-group">
  <label for="Start_Date">Start Date</label>
                <div class='input-group date'>
                    <input type='text'  id='datetimepicker1' class="form-control" name="start_date" required/>
                    <span class="input-group-addon" id="btn1">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>
<div class="form-group">
  <label for="End_Date">End Date</label>
                <div class='input-group date' >
                    <input type='text' id='datetimepicker2' class="form-control" name="end_date" required/>
                    <span class="input-group-addon" id="btn2">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>
{!! form_row($form->attachments) !!}
{!! form_row($form->description) !!}
<button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
<a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>

{!! form_end($form) !!}
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
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


     $('#btn2').click(function(){
       $('#datetimepicker2').datepicker({
         dateFormat:'dd/mm/yy'
       }).focus();
     });

  });

});

</script>




@endsection
