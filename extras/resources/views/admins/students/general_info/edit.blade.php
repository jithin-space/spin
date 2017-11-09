@extends('studentform',['student'=>$data['student']])

@section('page_heading', 'Edit General Information')



@section('section')


<form method="post" action="{{route('students.general_info.update',[$data['sid'],1])}}">
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
  <div class="form-group">
      <label for="First_Name" class="control-label">First_Name</label>
      <input type="text" name="fname" class="form-control" value="{{$data['info']['fname']}}" disabled />

  </div>
  <div class="form-group">
      <label for="Last_Name" class="control-label">Last_Name</label>
      <input type="text" name="fname" class="form-control" value="{{$data['info']['lname']}}" disabled />

  </div>
  <div class="form-group">
    <label for="Date_Of_Birth">Date Of Birth</label>
                  <div class='input-group date'>
                      <input type='text' id='datetimepicker1' class="form-control" name="date_of_birth" value="{{$data['info']['date_of_birth']}}" required/>
                      <span class="input-group-addon" id="btn1">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
  </div>
  <div class="form-group">
    <label for="Gender">Gender</label><br/>
    @foreach(['male','female','other'] as $gender)

      @if($data['info']['gender']==$gender)
    <label class="radio-inline">  <input type="radio" name="gender" value="{{$gender}}" checked> {{$gender}}</label>
      @else
    <label class="radio-inline">  <input type="radio" name="gender" value="{{$gender}}"> {{$gender}}</label>
      @endif
      @endforeach
  </div>
  <div class="form-group">
    <label for="Date_Of_Birth">Date Of Joining</label>
                  <div class='input-group date' >
                      <input type='text' id='datetimepicker2' class="form-control" name="date_of_joining" value="{{$data['info']['date_of_joining']}}" required/>
                      <span class="input-group-addon" id="btn2">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
  </div>

  <div class="form-group"  >

      <label for="Disabilities[]" class="control-label">Disabilities</label>

          <select class="selectpicker" multiple="multiple" id="Disabilities[]" name="Disabilities[]">

            @foreach($data['categories'] as $key=>$value)
               <?php
               echo $key."hello";
               print_r($data['selected']);
               if(in_array($key,$data['selected']))
               {
                 echo "<option value='{$key}' selected >{$value}</option>";
               }
               else {
                 echo "not working";
                 echo "<option value='{$key}'>{$value}</option>";
               }
                ?>
            @endforeach
          </select>

          &nbsp;<a href="#myModal4" data-toggle="modal"  class="eee btn btn-primary">Add New Disability Type</a>
  </div>

  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  <a class="btn btn-labeled btn-default" href=" {{ URL::previous() }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
</form>

<!-- this is for the modal -->
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
<!-- end of modal -->

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
