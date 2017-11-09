@extends('dashboard_layout')
@section('page_heading', 'Manage Vocabularies')
@section('section')


<table class="table table-striped">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>No.of Terms</th>
    <th>Actions</th>

  </tr>

  @foreach($vocs as $voc)


    <tr>
      <td>{{$loop->index+1}}</td>
      <td><a href="#" data-toggle="popover" data-html="true" title="Terms" data-content="<?php
        foreach($voc->terms as $term){
          echo $term->name."<br/>";
        }
       ?>">{{ $voc->name }}</a></td>
      <td>{{count($voc->terms)}}</td>
      <td class="col-xs-3">
        <a class="add btn btn-labeled btn-default" data-toggle="modal" data-id="{{$voc->id}}" href="#myModal1"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'Add Term' }}</a>
        <a class=" edit btn btn-labeled btn-danger" data-toggle="modal" data-id="{{$voc->id}}" href="#myModal1"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'Edit Voc' }}</a>
      </td>
    </tr>
  @endforeach
</table>

{{ $vocs->links() }}

<div class="container">
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Vocabulary</h4>
        </div>
        <div class="modal-body" id="outvoc">
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
$(document).on("click", ".edit", function () {
  var xhttp;
  var id = $(this).data('id');
  var ajaxurl = '{{route("tags.edit", ':id')}}';
  ajaxurl = ajaxurl.replace(':id', id);
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("outvoc").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();
});

$(document).on("click", ".add", function () {
  var xhttp;
  var id = $(this).data('id');
  var ajaxurl = '{{route("vocabulary.edit", ':id')}}';
  ajaxurl = ajaxurl.replace(':id', id);
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("outvoc").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();
});


$('.delete').submit(function() {
    var c = confirm("Click OK to continue?");
    return c;

});
</script>
<script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
  });
</script>
@endsection
