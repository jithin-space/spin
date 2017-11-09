<?php
echo "hello";
\Debugbar::info($student->feedbacks);

\Debugbar::info(gettype($student->feedbacks));

 ?>
<div class="panel-group" id="accordion1">
   @foreach($sorted as $feedback)
     <div class="panel panel-success">
       <div class="panel-heading">
         <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$feedback->_id}}">{{$feedback->created_at}}</a>
         </h4>
       </div>
       <div id="collapse{{$feedback->_id}}" class="panel-collapse collapse in">
         <div class="panel-body"><?php echo $feedback->content; ?></div>
         <div class="panel-footer">
           submitted by:<a>{{$feedback->created_by}}</a> on {{$feedback->created_at}}
           <span style="float:right">
             <form action="{{ route('mystudents.feedback.destroy',[$student->_id,$feedback->_id])}}" method="post">
               <input type="hidden" name="_method" value="DELETE">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <a class="btn btn-labeled btn-default" href="{{route('mystudents.feedback.edit',[$student->_id,$feedback->_id])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
           <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
         </form>
         </span>
         </div>
       </div>
     </div>

   @endforeach

   {{hello()}}
 </div>
