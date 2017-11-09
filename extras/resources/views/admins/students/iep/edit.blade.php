@extends('studentform',['student'=>$data['student']])
@section('page_heading', 'Edit IEP')
@section('section')
<form  id="form1" method="POST" action="{{route('students.iep.update',[\Auth::user()->roles()->first()->name,$data['sid'],$data['iep']['_id']])}}" >
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" name="_method" value="put" />
   <div class="form-group">
      <label for="goal_area">Goal Area:</label>
      <!-- editing for goal_area -->
      <div class="row">
         <div class="col-md-7">
            <select class="selectpicker form-control" data-size="5" name="goal_area" id="goal" required>
               <option value="">Select From Existing Goal Areas</option>
               @foreach($data['goals'] as $goals)
               @if($data['iep']['goal_area'] == $goals->parent)
               <option  selected value={{$goals->id}}>{{$goals->name}}</option>
               @else
               <option value={{$goals->id}}>{{$goals->name}}</option>
               @endif
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
   <div class="form-group">
      <!-- editing ends here  -->
      <input id="original_lto" type="hidden" class="form form-control" value="{{$data['iep']['long_term_objective']}}" disabled/>
   </div>
   <div id="ltoc" class="form-group">
      <label for="lto">Long Term Objective:</label>
      <!-- editing -->
      <div class="row">
         <div class="col-md-7">
            <select class="selectpicker form-control" data-size="10" id="ltos" name="lto" required>
               <option value="">Select A Long Term Objective</option>
               @foreach($data['ltos'] as $lto)
               @if($data['iep']['long_term_objective'] == $lto->id)
               <option  selected value={{$lto->id}}>{{$lto->name}}</option>
               @else
               <option value={{$lto->id}}>{{$lto->name}}</option>
               @endif
               @endforeach
            </select>
         </div>
         <div class="col-md-1">
            <h4>OR&nbsp;</h4>
         </div>
         <div class="col-md-2" >
            <div class="models--actions">
            </div>
         </div>
      </div>
      <!-- edting ends here -->
      <input type="text" class="form form-control" value="{{$data['iep']['lto_description']}}" disabled />
   </div>
   <div class="form-group">
      <label for="desc">Short Term Objective:</label>
      <input type="text" class="form form-control" name="desc" value="{{$data['iep']['description']}}" required/>
   </div>
   <div class="form-group">
      <label for="status">Objective Status: </label>
      <select class="form form-control" name="status" id="status">
         @if($data['iep']['status']=="Inactive")
         <option selected value="Inactive">Inactive</option>
         <option value="Active">Active</option>
         <option value="Completed">Completed</option>
         <option value="Terminated">Terminated</option>
         @elseif($data['iep']['status']=="Active")
         <option value="Inactive">Inactive</option>
         <option selected value="Active">Active</option>
         <option value="Completed">Completed</option>
         <option value="Terminated">Terminated</option>
         @elseif($data['iep']['status']=="Completed")
         <option value="Inactive">Inactive</option>
         <option value="Active">Active</option>
         <option selected value="Completed">Completed</option>
         <option selected value="Terminated">Terminated</option>
         @else
         <option value="Inactive">Inactive</option>
         <option value="Active">Active</option>
         <option value="Completed">Completed</option>
         <option selected value="Terminated">Terminated</option>
         @endif
      </select>
   </div>
   <div class="form-group">
     <label for="Remarks">Example Activity </label>
     <textarea name="example_activity" id="summernote" form="form1" class="form form-control">{{$data['iep']['example_activity']}}</textarea>
   </div>
   <button type="submit" class="btn btn-default"  id="submit" >Submit</button>
</form>
<script src='{{ URL::asset("js/bootstrap.min.js")}}'></script>
<script src='{{ URL::asset("js/bootstrap-select.js")}}'></script>
<script>
   $(document).ready(function($){
     var option = $('#goal').val();
     var original = $('#original_lto').val();
     var ajaxurl = '{{route("vocabulary.show",':id')}}';
     if(option && option !="")
     {
       ajaxurl = ajaxurl.replace(':id', option);

       $.ajax({
                url: ajaxurl,
                success:function(data) {

                         $('#ltoc').html(data);
                         $('#ltoc').find("#ltos option[value='"+original+"']").attr("selected","selected");
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


       $('#goal').change(function(){
         // alert("changed");
         var option = $(this).val();
         var original = $('#original_lto').val();
         var ajaxurl = '{{route("vocabulary.show",':id')}}';
         if(option && option !="")
         {
           ajaxurl = ajaxurl.replace(':id', option);

           $.ajax({
                    url: ajaxurl,
                    success:function(data) {
                          $('#ltoc').html(data);
                          $('#ltoc').find("#ltos option[value='"+original+"']").attr("selected","selected");
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
