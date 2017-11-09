
  <div class="panel panel-default">
    <div class="panel-heading"><h4>Attendance Details</h4></div>
    <div class="panel-body">
      Type:{{$attendance->type}}<br/>
      Slot:{{$attendance->slot}}<br/>
      On: {{$attendance->attendance_on}}<br/>
      Marked By:{{$attendance->marked_by}}<br/>
    </div>
     <div class="panel-footer">
       <a class="btn btn-labeled btn-success" href="{{route('students.attendance.edit',[\Auth::user()->roles()->first()->name,$student->_id,$attendance->_id])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
       <span class="pull-right">
         <form action="{{ route('students.attendance.destroy',[\Auth::user()->roles()->first()->name,$student->_id,$attendance->_id])}}" method="post" class="delete">
           <input type="hidden" name="_method" value="DELETE" />
           <input type="hidden" name="_token" value="{{ csrf_token() }}" />
           <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
          </form>
       </span>
     </div>
  </div>
