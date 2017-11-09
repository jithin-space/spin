@extends('userform')
@section('page_heading', 'Add Profile Information')

@section('section')

{!! form_start($form) !!}

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
{!! form_row($form->Name) !!}
{!! form_row($form->email) !!}

<div class="form-group">
  <label for="Date_Of_Birth">Date Of Birth</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="date_of_birth" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>
<div class="form-group">
  <label for="Gender">Gender</label><br/>
  <label class="radio-inline">  <input type="radio" name="gender" value="male" checked> Male</label>
  <label class="radio-inline">  <input type="radio" name="gender" value="female"> Female</label>
  <label class="radio-inline">  <input type="radio" name="gender" value="other"> Other </label>
</div>

<div class="form-group">
  <label for="Date_Of_Joining">Date Of Joining</label>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="date_of_joining" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>

{!! form_row($form->Address) !!}


  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
  <a class="btn btn-labeled btn-default" href="{{URL::previous()}} "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}

<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
<script>

$.when(
    $.getScript('{{ URL::asset("js/jquery.min.js")}}'),
  $.getScript('{{ URL::asset("js/moment.js")}}'),
  $.getScript( '{{ URL::asset("js/bootstrap.min.js")}}' ),
  $.getScript( '{{ URL::asset("js/datetimepicker.js")}}'),
    $.getScript( '{{ URL::asset("js/summernote.js")}}' ),

    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){
   $('#summernote').summernote();
   $('#datetimepicker1').datetimepicker({
                 format: 'DD/MM/YYYY'
           });
   $('#datetimepicker2').datetimepicker({
            format: 'DD/MM/YYYY'
   });
});
</script>


@endsection
