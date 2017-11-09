@extends('dashboard_layout')
@section('page_heading', 'Users')
@section('section')
<div class="models--actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('users.create',\Auth::user()->roles()->first()->name) }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New'}}</a>
</div>
<table class="table table-striped">
  <tr>
    <th>Name</th>
    <th>Role</th>
    <th>SubRole</th>
    <th>Actions</th>
  </tr>

  @foreach($users as $user)
    <tr>
      <?php \Debugbar::info($user->roles[0]->name); ?>
      <td><a href="#" data-toggle="popover" title="Email" data-content="{{$user->email}}">{{ $user->name }}</a></td>
      <td><a href="#" data-toggle="popover" title="Role Desc" data-content="{{$user->roles[0]->description}}">{{$user->roles[0]->name}}</a></td>
      <td><a href="#" data-toggle="popover" title="Role Desc" data-content="will be replaced soon">{{ ($user->subroles()->count()==0)?$user->roles[0]->name:$user->subroles[0]->name}}</a></td>
      <td class="col-xs-3">
        <form action="{{ route('users.destroy', [\Auth::user()->roles()->first()->name,$user->id])}}" method="post" class="delete">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a class="btn btn-labeled btn-default" href="{{route('users.edit',[\Auth::user()->roles()->first()->name,$user->id])}}" <?php
            if($user->name=="jithin") echo "disabled"; ?>><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
          <button type="submit" class="btn btn-labeled btn-danger" <?php
            if($user->name=="jithin") echo "disabled"; ?>><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $users->links() }}

<script>

  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
  });


$('.delete').submit(function() {
    var c = confirm("Click OK to continue?");
    return c;

});
</script>
@endsection
