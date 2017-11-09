@extends('student_layout')
@section('heading', 'Assignment')
@section('content')

  @foreach($students as $student)
    <h4><a href=""> {{ $student->fname }} </a></h4>

    <div class="models--actions">
        <a class="aaa btn btn-labeled btn-primary "  data-toggle="modal" href="#myModal" data-id="{{ $student->_id }}" ><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Assign New'}}</a>
    </div>

    <!--  -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
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
    <!--  -->
    <script>
      $(document).on("click", ".aaa", function () {
        var xhttp;
        var id = $(this).data('id');
        var ajaxurl = '{{route("assign.edit", ':id')}}';
        ajaxurl = ajaxurl.replace(':id', id);
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("out").innerHTML = xhttp.responseText;
          }
        };
        xhttp.open("GET",ajaxurl, true);
        xhttp.send();

      });
    </script>

    <table class="table table-striped">
      <tr>
        <th>Trainer</th>
        <th>Assignments</th>
        <th>Actions</th>
      </tr>

      @foreach($student->support_team as $user)
          <td><a href="">{{ $user->fname }}</a></th>
          <td><a href="">{{ count($user->student_ids) }} </a></td>

          <td class="col-xs-3">
            <form action="{{route('assign.destroy',$user->id )}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="sid" value="{{$student->_id}}" />
              <a class="btn btn-labeled btn-default" href=""><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
              <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>


    @endforeach
    @endsection
