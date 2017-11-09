@extends('dashboard_layout')
@section('page_heading', 'Roles')
@section('section')
<div class="models--actions">
    <a class="bbb btn btn-labeled btn-success" data-toggle="modal" href="#myModal1" ><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Create New'}}</a>
</div>
<script>
$(document).on("click", ".bbb", function () {
  var xhttp;
  // var id = $(this).data('id');
  var ajaxurl = '{{route("roles.create",\Auth::user()->roles()->first()->name)}}';
  // ajaxurl = ajaxurl.replace(':id', id);
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
  var ajaxurl = '{{route("roles.edit", [\Auth::user()->roles()->first()->name,':id'])}}';
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

$(document).on("click", ".add", function () {
  var xhttp;

  var id = $(this).data('id');
  var ajaxurl = '{{route("roles.subrole.create", [\Auth::user()->roles()->first()->name,':id'])}}';
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


$(document).on("click", ".show", function () {
  var xhttp;

  var id = $(this).data('id');
  var id1=$(this).data('id1');
  var ajaxurl = '{{route("roles.subrole.edit", [\Auth::user()->roles()->first()->name,':id',':id1'])}}';
  ajaxurl = ajaxurl.replace(':id', id);
  ajaxurl = ajaxurl.replace(':id1', id1);

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

</script>
<!-- for create new role -->
<div class="container">
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Role</h4>
        </div>
        <div class="modal-body" id="out1">
          <h4> You Do Not Have the Permission For this Action </h4>

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
    <th>Role Name</th>
    <th>Description</th>
    <th>SubRoles</th>
    <th>Actions</th>
  </tr>

  @foreach($roles as $role)
  <tr>
    <td class="col-md-2">{{ $role->name }}</td>
    <td class="col-md-2">{{$role->description}}</td>
    <td class="col-md-3">

      <div class="dropdown">
         <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">{{$role->subroles()->count()}} subroles
         <span class="caret"></span></button>
         <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
           <li role="presentation"><a role="menuitem" tabindex="-1" href="#">SubRoles</a></li>
           <li role="presentation" class="divider"></li>
           @foreach($role->subroles as $subrole)
             <li role="presentation"><a  class="show" role="menuitem" tabindex="-1" data-id="{{$role->id}}" data-id1="{{$subrole->id}}" data-toggle="modal" href="#myModal1">{{$subrole->name}}</a></li>
           @endforeach
         </ul>
         <a class="add btn btn-labeled btn-success" data-id="{{$role->id}}" data-toggle="modal" href="#myModal1" ><i class="fa fa-plus"></i></a>
       </div>



    </td>
    <td class="col-md-3 col-md-offset-1">
      <form action="{{ route('roles.destroy', [\Auth::user()->roles()->first()->name,$role->id])}}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a class="edit btn btn-labeled btn-default" data-toggle="modal" data-id="{{ $role->id }}" href="#myModal1"
          <?php
            if($role->name=="admin" || $role->name=="Default") echo "disabled"; ?>><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
        <button type="submit" class="btn btn-labeled btn-danger" <?php
          if($role->name=="admin"  ||  $role->name=="Default") echo "disabled"; ?>

        ><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>

      </form>
    </td>
  </tr>
  @endforeach
<script>


</script>
@endsection
