@extends('dashboard_layout')
@section('page_heading', 'Students')
@section('section')


<div class="models--actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('students.create',\Auth::user()->roles()->first()->name) }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New'}}</a>
</div>


<form class="typeahead" role="search">
  <div class="form-group" style="text-align:center;">
    <input type="search" name="q" class="form-control search-input mySearch" placeholder="Type to start searching..." autocomplete="off">
  </div>
</form>


<table class="table table-striped">
  <tr>
    <th>Student Id</th>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Actions</th>
  </tr>
<tbody>
  @foreach($students as $student)
    <tr>
      <td>{{$student->student_id}}</td>
      <td><a href="{{route('students.show',[\Auth::user()->roles()->first()->name,$student->_id])}}">{{ $student->fname }}</a></th>
      <td>{{ $student->lname }}</td>
      <td class="col-xs-3">
        <form action="{{ route('students.destroy', [\Auth::user()->roles()->first()->name,$student->_id])}}" method="post" class="delete">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a class="btn btn-labeled btn-default" href="{{route('students.edit',[\Auth::user()->roles()->first()->name,$student->_id])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
          <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>
</table>
{{ $students->links() }}


<script src="{{ URL::asset('js/typeahead_bundle.js') }}"></script>
<!-- Typeahead Initialization -->
<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '/find?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            source: engine.ttAdapter(),

            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'usersList',
            display: 'fname',

            // the key from the array we want to display (name,id,email,etc...)
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function (data) {
                    var url = "{{route('students.show',[\Auth::user()->roles()->first()->name,':data._id'])}}";
                    url = url.replace(':data._id', data._id);
                    return '<a href="'+ url +'" class="list-group-item">' + data.fname + ' - @' + data.lname + '</a>'
          }
            }
        });
    });
</script>

@endsection
