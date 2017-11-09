@extends('studentform',['student'=>$student])
@section('page_heading', 'Edit Information')

@section('section')
    {!! form_start($form) !!}
    {!! form_row($form->MedicationName) !!}
    {!! form_row($form->DoctorName) !!}
    {!! form_row($form->status) !!}
    {!! form_row($form->remarks) !!}
    <div class="form-group">
      <label for="Start_Date">Start Date</label>
                    <div class='input-group date' >
                        <input type='text' id='datetimepicker1' class="form-control" name="start_date" value="{{$data['start_date']}}" required/>
                        <span class="input-group-addon" id="btn1">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
    </div>
    <div class="form-group">
      <label for="End_Date">End Date</label>
                    <div class='input-group date' >
                        <input type='text' id='datetimepicker2' class="form-control" name="end_date" value="{{$data['start_date']}}" required/>
                        <span class="input-group-addon" id="btn2">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
    </div>
  <input type="hidden" name="_method" value="put" />
    <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  {!! form_end($form) !!}

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
