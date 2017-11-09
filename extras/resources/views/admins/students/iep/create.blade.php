@extends('studentform',['student'=>$data['student']])
@section('page_heading', 'Create IEP')
@section('section')
  <form  method="POST" action="{{route('students.iep.store',[\Auth::user()->roles()->first()->name,$data['sid']])}}" id="form1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      <label for="goal_area">Goal Area:</label>
      <div class="row">
          <div class="col-md-7">
            <select class="selectpicker form-control" data-size="5" name="goal_area" id="goal" required>
               <option value="">Select From Existing Goal Areas</option>
                  @foreach($data['goals'] as $goals)
                      <option value={{$goals->id}}>{{$goals->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-1">
              <h4>OR&nbsp;</h4>
            </div>
            <div class="col-md-2">
              <div class="models--actions">
                  <a class="aaa btn btn-labeled btn-primary" data-toggle="modal" href="#myModal"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New Goal'}}</a>
              </div>
            </div>
      </div>
     </div>
      <div id="ltoc" class="form-group">

        <label for="lto">Long Term Objective:</label>
                  <div class="row">
                    <div class="col-md-7">
                        <select class="selectpicker form-control"  data-size="10" id="ltos" name="lto" disabled>
                             <option value="">Select A Goal Area First</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                      <h4>OR&nbsp;</h4>
                    </div>
                    <div class="col-md-2" >
                      <div class="models--actions">
                          <a class="bbb btn btn-labeled btn-primary" data-toggle="modal" href="#myModal" disabled><span class="btn-label"><i class="fa fa-plus"></i></span>{{"Add New LTO"}}</a>\
                      </div>
                    </div>
                  </div>

      </div>
      <div id="iep" class="form-group">
        <div class="form-group">
          <label for="desc">Short Term Objective:</label>
            <input type="text" class="form form-control" name="description" required/>
         </div>
         <div class="form-group">
           <label for="status">Objective Status:</label>
           <select class="form-control" data-style="btn-primary" name="status">
             <option selected value="Inactive">Inactive</option>
             <option value="Active">Active</option>
             <option value="Completed">Completed</option>
             <option value="Terminated"> Terminated </option>
           </select>
          </div>
          <div class="form-group">
            <label for="example_activity">Example Activity </label>
            <textarea name="example_activity" form="form1" id="summernote" class="form form-control"></textarea>
          </div>
      </div>
      <button type="submit" class="btn btn-default"  id="submit" >Submit</button>
  </form>
  <script src='{{ URL::asset("js/bootstrap.min.js")}}'></script>
  <script src='{{ URL::asset("js/bootstrap-select.js")}}'></script>
<script>
  $(document).ready(function($){
    var option = $('#goal').val();
    var ajaxurl = '{{route("vocabulary.show",':id')}}';
    if(option)
    {
      ajaxurl = ajaxurl.replace(':id', option);
      $.ajax({
               url: ajaxurl,
               success:function(data) {
                        $('#ltoc').html(data);
                        $('.selectpicker').selectpicker('render');
               }
            });
    }
    $('#goal').change(function(){
      var option = $(this).val();
      var ajaxurl = '{{route("vocabulary.show",':id')}}';
      if(option && option !="")
      {
        ajaxurl = ajaxurl.replace(':id', option);

        $.ajax({
                 url: ajaxurl,
                 success:function(data) {
                       $('#ltoc').html(data);
                       $('.selectpicker').selectpicker('render');
                 }
              });
      }
      else{
        var data ='<label for="lto">Long Term Objective:</label>\
                  <div class="row">\
                    <div class="col-md-7">\
                        <select class="selectpicker form-control"  data-size="10" id="ltos" name="lto" disabled>\
                             <option value="">Select A Goal Area First</option>\
                        </select>\
                    </div>\
                    <div class="col-md-1">\
                      <h4>OR&nbsp;</h4>\
                    </div>\
                    <div class="col-md-2" >\
                      <div class="models--actions">\
                          <a class="bbb btn btn-labeled btn-primary" data-toggle="modal" href="#myModal" disabled><span class="btn-label"><i class="fa fa-plus"></i></span>{{"Add New LTO"}}</a>\
                      </div>\
                    </div>';
                    $('#ltoc').html(data);
                    $('.selectpicker').selectpicker('render');
      }

    });
  });
</script>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Category</h4>
      </div>
      <div class="modal-body" id="out">
        <p>Some text in the modal.</p>
          <input type="text" name="bookId" id="bookId" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
$(document).on("click", ".aaa", function () {
  var xhttp;
  var ajaxurl = '{{route("vocabulary.create")}}';
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("out").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();

});

$(document).on("click", ".bbb", function () {
 var xhttp;
 var id = $(this).data('id');
 var ajaxurl = '{{route("terms.create")}}';
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("out").innerHTML = xhttp.responseText;

      $("#dummy").attr("value",id);

    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();
});



</script>

<script src='{{ URL::asset("js/jquery.min.js")}}' ></script>
<script src='{{ URL::asset("js/bootstrap.min.js")}}' ></script>
<script src='{{ URL::asset("js/summernote.js")}}' ></script>
<script>
  $('#summernote').summernote();
</script>



@endsection
