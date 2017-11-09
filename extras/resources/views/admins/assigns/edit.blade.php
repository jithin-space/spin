
<form method="POST" action="{{route('assign.update',$data['student']->_id )}}" >
  <input type="hidden" name="_method" value="put">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @foreach($data['users'] as $user)
     <div class="checkbox">
          <label><input type="checkbox" value="{{$user->id}}" name="id[]"> {{$user->fname}}</label>
      </div>
  @endforeach
  <input type="submit" value="assign" />
</form>
