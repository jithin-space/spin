<?php

if(!($student->hasMedia('gallery')))
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading">No Information found</div>

                  <div class="panel-body">
                      <p>No Media Gallery is attached to the student</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-primary" href="{{route('students.media_gallery.create',$student->_id)}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  // echo "helloooooo";
  // $data=$json->media_gallery;
  $medias = $student->getMedia('gallery');
  \Debugbar::info($medias);
  ?>

@foreach($medias as $media)
<?php \Debugbar::info($student->getTagsForMedia($media)[1]); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <A href="" >Edit Background Information</A><br/>
           <p class=" text-info">Last Updated:May 05,2014,03:00 pm </p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
              <h3 class="panel-title">Guardian Information</h3>
          </div>
          <div class="panel-body">
            <div class="row">
                  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$student->firstMedia('profile')->getUrl()}}" class="img-circle img-responsive"> </div>

                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                      <tbody>
                          <tr><td><a href="{{$media->getUrl()}}"> link{{$loop->index+1}} </a></td></tr>
                      </tbody>
                    </table>

                    <a href="{{route('students.media_gallery.create',$student->_id)}}" class="btn btn-primary">Add New Guardian</a>

                  </div>
                </div>
          </div>
          <div class="panel-footer">
                 <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                 <span class="pull-right">
                   <form action="{{ route('students.media_gallery.destroy', [$student->_id,$loop->index])}}" method="post">
                     <input type="hidden" name="_method" value="DELETE">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">

                       <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                   </form>
                 </span>
          </div>
      </div>
    </div>
    </div>


  </div>
@endforeach;
<?php

}
?>
