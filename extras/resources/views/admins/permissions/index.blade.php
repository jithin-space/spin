@extends('dashboard_layout')
@section('page_heading', 'Permissions')
@section('section')
<div class="models--actions">
    <a class="bbb btn btn-labeled btn-success" data-toggle="modal" href="#myModal1" ><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Create New'}}</a>
</div>

<script>
$(document).on("click", ".bbb", function () {
  var xhttp;
  var ajaxurl = '{{route("permissions.create",\Auth::user()->roles()->first()->name)}}';
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("out1").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();
});

$(document).on("click", ".edit", function () {
  var xhttp;
  var id = $(this).data('id');
  var ajaxurl = '{{route("permissions.edit", [\Auth::user()->roles()->first()->name,':id'])}}';
  ajaxurl = ajaxurl.replace(':id', id);
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("out1").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET",ajaxurl, true);
  xhttp.send();
});
</script>

<!-- for create new permssions -->
<div class="container">
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Permission</h4>
        </div>
        <div class="modal-body" id="out1">
          <h4> You Do Not Have The Permissions For This Page </h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
<!--  -->

<table class="table table-striped">
  <tr>
    <th>Permission Name</th>
    <th> Description </th>
    <th>Actions</th>
  </tr>

  @foreach($permissions as $permission)
  <tr>
    <td><a href="">{{ $permission->name }}</a></td>
    <td>{{$permission->description}}</td>
    <td class="col-xs-5">
      <form action="" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <a class=" edit btn btn-labeled btn-default" data-toggle="modal" data-id="{{ $permission->id }}" href="#myModal1"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
        <!-- <a class="btn btn-labeled btn-info" ><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'Assign' }}</a>
        <a class="ccc btn btn-labeled btn-primary" ><span class="btn-label"><i class="fa fa-angle-down"></i></span>{{ 'view' }}</a>
        <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button> -->

      </form>
    </td>
  </tr>
  @endforeach


@endsection
