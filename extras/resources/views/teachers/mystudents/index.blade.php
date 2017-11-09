@extends('dashboard_layout')
@section('page_heading', 'My Students')
@section('section')

<table class="table table-striped">
  <tr>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Actions</th>
  </tr>

  @foreach($students as $student)
    <tr>
      <td><a href="{{route('mystudents.show', $student->_id)}}">{{ $student->fname }}</a></th>
      <td>{{ $student->lname }}</td>
      <td class="col-xs-3">
        <form action="{{ route('students.destroy', $student->_id)}}" method="post">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a class="btn btn-labeled btn-default" href="{{route('students.edit',$student->_id)}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
          <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $students->links() }}
@endsection
