@extends('studentform',['student'=>$student])

@section('page_heading', 'Add Feedback')

@section('section')

{!! form_start($form) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
{!! form_row($form->student_id) !!}
{!! form_row($form->created_by) !!}
{!! form_row($form->feedback_type) !!}
{!! form_row($form->content) !!}

  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'Add' }}</button>
  <a class="btn btn-labeled btn-default" href="{{URL::previous()}}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
$.when(
  $.getScript('{{ URL::asset("js/moment.js")}}'),
  $.getScript( '{{ URL::asset("js/bootstrap.min.js")}}' ),
  $.getScript( '{{ URL::asset("js/datetimepicker.js")}}'),
    $.getScript( '{{ URL::asset("js/summernote.js")}}' ),

    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){
   $('#summernote').summernote();
   $('#datetimepicker1').datetimepicker();
});
});
</script>

@endsection
