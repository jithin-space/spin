@extends('studentform',['student'=>$student])

@section('page_heading', 'Add General Information')

@section('section')

{!! form_start($form) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
{!! form_row($form->First_Name) !!}
{!! form_row($form->Last_Name) !!}
{!! form_row($form->Student_Number) !!}
<div class="form form-group" style="display:inline-block;">
<div style="display:inline-block;float:left;">{!! form_row($form->Disabilities) !!}</div>&nbsp;&nbsp; OR &nbsp;&nbsp;
<div style="display:inline-block;"> <a href="#myModal4" data-toggle="modal" class="eee btn btn-primary">Add New Disability Type</a></div>
</div>
<div class="form-group">
  <label for="Date_Of_Birth">Date Of Birth</label>
                <div class='input-group date' >
                    <input type='text' id='datetimepicker1' class="form-control" name="date_of_birth" required/>
                    <span class="input-group-addon" id="btn1">
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
                <div class='input-group date' >
                    <input type='text' id='datetimepicker2' class="form-control" name="date_of_joining" required/>
                    <span class="input-group-addon" id="btn2">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
</div>

  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
  <a class="btn btn-labeled btn-default" href="{{ URL::previous() }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}

<div class="container">
  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Permission</h4>
        </div>
        <div class="modal-body" id="out3">
          <p>Some text in the modal.</p>
            <input type="text" name="bookId" id="bookId" value=""/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>

<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
<script>

$(document).ready(function(){
  $.when(
      $.getScript('{{ URL::asset("js/jquery.js")}}'),
    $.getScript('{{ URL::asset("js/jquery-ui.js")}}'),
    $.getScript('{{ URL::asset("js/bootstrap.min.js")}}'),
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

<script>
$(document).on("click", ".eee", function () {
 var xhttp;
//  hard coded value..careful in changing that value...........
 var id = 4;
 var ajaxurl = '{{route("terms.create")}}';
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("out3").innerHTML = xhttp.responseText;
      $("#dummy").attr("value",id);

    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();

});

</script>


@endsection
