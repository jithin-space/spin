<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{count($active)}}+</div>
                        <div>Active Ieps!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{count($sorted)}}+</div>
                        <div>Feedbacks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>Completed IEPs!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">50</div>
                        <div>Insight Classes!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">

      <div class="panel panel-default">
        <div class="panel-heading">Active IEPs</div>
        <div class="panel-body">

                           <div class="row">

                             <div class="col-md-1">ID</div>
                             <div class="col-md-7">IEP</div>
                             <div class="col-md-2">GoalArea</div>
                             <div class="col-md-2">Actions</div>

                           </div>

                         @foreach($active as $ieps)
                             <div class="row list-group-item">
                                   <div class="col-md-1 list-group-item ">{{$loop->index+1}}</div>
                                   <div class="col-md-7 list-group-item " ><a href="#{{$iep->_id}}" data-id="{{$ieps->_id}}"class="iep">{{$ieps->description}}</a></div>
                                   <div class="col-md-2 list-group-item">{{$ieps->goal_area_description}}</div>
                                   <div class="col-md-2 ">
                                     <a class="btn btn-labeled btn-default" href="http://{{(String)$ieps->activity_url}}" target="_blank"><span class="btn-label"><i class="fa fa-play"></i></span>{{ 'Start' }}</a>
                                   </div>
                             </div>

                           <div id="home{{$ieps->_id}}" style="display: none;">
                             <div class="panel panel-default">
                                  <div class="panel-heading">Comments</div>
                                    <div class="panel-body">
                                      <div class="actionBox">
                                        <ul class="commentList">

                                          <?php
                                          if(isset($ieps->comments)&& (count($ieps->comments) > 0 )){

                                            $sor=$ieps->comments->sortByDesc('created_at');


                                            foreach($sor as $comment)
                                            {
                                                   echo '<li> <div class="commenterImage1"><img src="http://placekitten.com/45/45" />
                                                      </div><div class="commentText"><p class="">'.$comment->content.'</p> <span class="date sub-text"><a href="">'.$comment->author.'</a>&nbsp;On&nbsp;'.$comment->created_at->format('F j ,Y').'</span>
                                                      </div></li>';

                                             }
                                          }
                                          else{
                                            echo '<li><div class="commentText"><p class="">No comments yet.....</p></div></li>';
                                          }

                                          ?>

                                        </ul>
                                      </div>
                                    </div>
                                    <div class="panel-footer">
                                      @if(Entrust::hasRole('admin'))
                                      <form id="test" class="" action="{{route('students.iep.comment.store',[$student->_id,$ieps->_id])}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                                        <button type="submit" class="btn btn-labeld btn-default">Post</button>
                                      </form>
                                      @else
                                      <form id="test" class="" action="{{route('mystudents.iep.comment.store',[$student->_id,$ieps->_id])}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <textarea class="form form-control" placeholder="Comments........" name="comment"></textarea>
                                        <button type="submit" class="btn btn-labeld btn-default">Post</button>
                                      </form>
                                      @endif

                                    </div>

                             </div>
                           </div>

                         @endforeach
                       </div>

        <div class="panel-footer">
            <a><span class="pull-right">View All</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
            <div class="clearfix"></div>
        </div>
      </div>


    </div>

    <div class="col-lg-4">
      <div id="content">
      </div>
    </div>
</div>
