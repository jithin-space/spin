<?php

if(!isset($json->ieps))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading">No Information found</div>

                  <div class="panel-body">
                      <p>No Guardian Information has been added to the student.</p><br/>
                      <div class="models--actions">
                          <a class="goal btn btn-labeled btn-success" href="{{route('students.iep.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New IEP'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  ?>
<?php
$result = array();
$goal_tag=array();
$lto_tag=array();
foreach($json->ieps as $data)
{
  $ga=$data->goal_area;
  $lts = $data->long_term_objective;
  if(isset($result[$ga]))
  {
    if(isset($result[$ga][$lts]))
    {
      $result[$ga][$lts][]=$data;
    }
    else{
      $result[$ga][$lts]=array($data);
      $lto_tag[$ga][$lts]=$data->lto_description;
    }
  }
  else {
    $result[$ga][$lts]=array($data);
    $goal_tag[$ga]=$data->goal_area_description;
    $lto_tag[$ga][$lts]=$data->lto_description;
  }

}

?>

<div class="row">
  <div class="col-md-6">
    <div class="just-padding ">
    <div class="list-group list-group-root well">

      @foreach($result as $ga=>$lts)

        <a data-toggle="collapse" class="list-group-item" href="#{{$ga}}">
          <h3><i class="glyphicon glyphicon-chevron-down"></i>
          {{$loop->index+1}}:{{$goal_tag[$ga]}}</h3>
        </a>

        <div class="list-group collapse in" id="{{$ga}}">

          @foreach($lts as $lto=>$value)

            <a href="#{{$goal_tag[$ga]}}{{$loop->index}}ltos" class="list-group-item" data-toggle="collapse">
              <h4><i class="glyphicon glyphicon-chevron-right"></i>{{$lto_tag[$ga][$lto]}}</h4>
            </a>

            <div class="list-group collapse in" id="{{$goal_tag[$ga]}}{{$loop->index}}ltos">

                @foreach($value as $iep)
{{\Debugbar::info($iep->_id->{'$oid'})}}

                    <a href="#<?php echo $iep->_id->{'$oid'}; ?>" data-id="<?php echo $iep->_id->{'$oid'}; ?>" class="list-group-item iep1">{{$loop->index+1}}:{{$iep->description}}</a>


                    <div id="<?php echo $iep->_id->{'$oid'}; ?>" style="display: none;">

                      <div class="panel panel-default">
                         <div class="panel-heading">IEP DETAILS</div>
                        <div class="panel-body">
                          <h3>Goal Area:{{$iep->goal_area_description}}</h3>
                          <h4>Long Term Objective: {{$iep->lto_description}}</h4>

                          {{\Debugbar::info($iep->created_at->{'$date'}->{'$numberLong'})}}
                          <?php
                           $mil=$iep->created_at->{'$date'}->{'$numberLong'};
                           $seconds = $mil / 1000;
                           echo "<a style='float:right'>Created On:".date("F j, Y,", $seconds)."</a><br/>";
                           $mil=$iep->updated_at->{'$date'}->{'$numberLong'};
                           $seconds = $mil / 1000;
                           echo "<a style='float:right'>Last Update:".date("F j, Y", $seconds)."</a>";
                          ?><br/>

                          <h4> Topic</h4>
                          <a href="">{{$iep->description}}</a>

                          <h4> Status </h4>{{$iep->status}}
                        </div>
                        <div class="panel-footer">

                        <form action="{{ route('students.iep.destroy',[$student->_id,$iep->_id->{'$oid'}])}}" method="post">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <a class="btn btn-labeled btn-default" href="{{route('students.iep.edit',[$student->_id,$iep->_id->{'$oid'}])}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                          <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                        </form>

                        </div>
                      </div>

                      <div class="panel panel-default">
                         <div class="panel-heading">Comments</div>
                           <div class="panel-body">
                             <div class="actionBox">
                               <ul class="commentList">

                                 <?php if(isset($iep->comments))
                                 {
                                  foreach($iep->comments as $comment)
                                  {
                                    $mil=$comment->created_at->{'$date'}->{'$numberLong'};
                                    $seconds = $mil / 1000;
                                    if($comment->author== \Auth::user()->name)
                                    {
                                      echo '<li>
                                          <div class="commenterImage1">
                                            <img src="http://placekitten.com/45/45" />
                                          </div>
                                          <div class="commentText">
                                              <p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a>&nbsp;On&nbsp;'.date("F j, Y,", $seconds).'</span>
                                          </div>
                                      </li>';
                                    }
                                    else
                                    {
                                      echo '<li>
                                          <div class="commenterImage2">
                                            <img src="http://placekitten.com/45/45" />
                                          </div>
                                          <div class="commentText">
                                              <p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a>&nbsp;On&nbsp;'.date("F j, Y,", $seconds).'</span>
                                          </div>
                                      </li>';
                                    }

                                  }
                                  }
                                else
                                {
                                  echo '<li>

                                      <div class="commentText">
                                          <p class="">No comments yet.....</p>
                                      </div>
                                  </li>';
                                }

                                 ?>

                               </ul>
                             </div>
                           </div>
                           <div class="panel-footer">
                              @if(Entrust::hasRole('admin'))
                             <form class="form" action="{{route('students.iep.comment.store',[$student->_id,$iep->_id->{'$oid'}])}}" method="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                               <br/><button type="submit" class="btn btn-labeld btn-default">Post</button>
                             </form>
                             @else
                             <form class="form" action="{{route('mystudents.iep.comment.store',[$student->_id,$iep->_id->{'$oid'}])}}" method="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                               <br/><button type="submit" class="btn btn-labeld btn-default">Post</button>
                             </form>
                             @endif

                           </div>
                       </div>

                    </div>


                @endforeach

            </div>


          @endforeach

        </div>



      @endforeach
    </div>

    </div>
  </div>
  <div class="col-md-6" >
    <div class="models--actions" style="float:right">
        <a class="goal btn btn-labeled btn-success" href="{{route('students.iep.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New IEP'}}</a>
    </div><br/><br/>
    <div id="content1">
    </div>
  </div>
</div>



<?php } ?>


<script>

$(function() {

  $('.list-group-item').on('click', function() {
    $('.glyphicon', this)
      .toggleClass('glyphicon-chevron-right')
      .toggleClass('glyphicon-chevron-down');
  });

  $('.iep1').on('mouseenter',function(){
    var d=$(this).data('id');
    $('#content1').html($('#'+d).html());
  });

  $('.iep').on('mouseenter',function(){
    var d=$(this).data('id');
    $('#content').html($('#home'+d).html());
  });

});



</script>

<style>
.just-padding {
    padding: 15px;
}

.list-group.list-group-root {
    padding: 0;
    overflow: hidden;
    border:0;
}

.list-group.list-group-root .list-group {
    margin-bottom: 0;
}

.list-group.list-group-root .list-group-item {
    border:0;
    border-radius: 0;
    border-width: 1px 0 0 0;
}

.list-group.list-group-root > .list-group-item:first-child {
    border-top-width: 0;
}

.list-group.list-group-root > .list-group > .list-group-item {
    padding-left: 45px;
}

.list-group.list-group-root > .list-group > .list-group > .list-group-item {
    padding-left: 70px;
}

.list-group-item .glyphicon {
    margin-right: 5px;
}

.detailBox {
    width:320px;
    border:1px solid #bbb;
    margin:50px;
}
.titleBox {
    background-color:#fdfdfd;
    padding:10px;
}
.titleBox label{
  color:#444;
  margin:0;
  display:inline-block;
}

.commentBox {
    padding:10px;
    border-top:1px dotted #bbb;
}
.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    width:80%;
}
.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:18%;
}
.actionBox .form-group * {
    width:100%;
}
.taskDescription {
    margin-top:10px 0;
}
.commentList {
    padding:0;
    list-style:none;
    max-height:200px;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage1 {
    width:30px;
    margin-right:5px;
    height:100%;
    /*float:left;*/
}
.commenterImage2{
  width:30px;
  margin-right:5px;
  height:100%;
  float:right;
}
.commenterImage1 img {
    width:100%;
    border-radius:50%;
}
.commenterImage2 img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}
</style>
