@extends('student_layout1',['student',$student])
@section('page_heading','Student Status Report')

@section('section')

<div class="models--actions pull-right">
    <a class="btn btn-labeled btn-primary" href="{{route('students.status_report.show',[$student->_id,'status_report'])}}" target="_blank"><span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>{{'Generate Pdf'}}</a>
</div>

<br/><hr/>
  <?php $json=json_decode($student); ?>


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
  			<h3 class="text-center text-info">
  				SPIN Status Report
  			</h3>
  		</div>
      <div class="col-xs-2 pull-right">
  			<img alt="Bootstrap Image Preview" src="https://www.apc.org/en/system/files/images/space-2.png" width="50px" />
  		</div>
    </div>


      <div class="row">
        <div class="col-md-4">

              <span class="label label-success">General Information</span>
                 <div class="panel panel-default">

                   <br/><div class="profile-userpic">
                     <img src="{{$student->firstMedia('profile')->getUrl()}}" class="img-responsive" alt="">
                   </div>

                   <div class="profile-usertitle">
                     <div class="profile-usertitle-name">
                       {{$student->fname}} {{$student->lname}}
                     </div>
                   </div>
                   <?php

                   if(!(isset($json->general_info) && !empty($json->general_info)) )
                   {
                     ?>

                         <div class="panel-heading">No Information found</div>

                         <div class="panel-body">
                             <p>No General Information has been added to the student.</p><br/>
                         </div>

                     <?php
                   }
                   else
                    {
                        $data=$json->general_info;
                        ?>
                        <div class="panel-body">
                          <table class="table table-user-information">
                            <tbody>
                              <tr><td>Date Of Birth</td><td>{{$data->date_of_birth}}</td></tr>
                              <tr><td>Age</td><td>
                                <?php
                                $value = str_replace('/', '-', $data->date_of_birth);
                                $from = new DateTime(date("Y-m-d", strtotime($value)));
                                $to   = new DateTime();
                                $interval=$from->diff($to);
                                echo $interval->format("%Y");
                                 ?>
                              </td></tr>
                              <tr><td>Date Of Joining</td><td>{{$data->date_of_joining}}</td></tr>
                              <tr><td>Gender</td><td>{{$data->gender}}</td></tr>
                              <tr><td>Disablity Tags:</td><td>
                                @foreach($student->disabilities as $dis)
                                  {{$dis->name}},
                                @endforeach
                              </td>

                            </tbody>

                          </table>
                        </div>

                      <?php }
                      ?>
                 </div>

                 <span class="label label-success">Contact Us</span>
                 <div class="panel panel-default">
                   <div class="panel-body">
                     <address>
                       <strong>SPACE, c11</strong><br>
                       Elankom Gardens, Vellayambalam<br>
                       Trivandrum 10<br>
                       Kerala,India<br>
                       <abbr title="Phone">Ph:</abbr> 232713<br/>
                       <abbr title="Mob">Mob:</abbr>9947297599
                     </address>
                   </div>
                 </div>

          </div>
        <div class="col-md-8">

            <span class="label label-success">IEP Information</span>
            <div class="panel panel-default">

              <div class="panel-body">
                <!--  -->

                <?php

                if(!isset($json->ieps))
                { ?>
                          <div class="col-md-8 col-md-offset-2">
                              <div class="panel panel-danger">
                                  <div class="panel-heading">No Information found</div>

                                  <div class="panel-body">
                                      <p>No IEP  has been added to the student.</p><br/>

                                  </div>
                              </div>
                          </div>

                <?php }
                else {

                ?>


                      @foreach($json->ieps as $iep)
                                    <div class="panel panel-default">
                                      <div class="panel-body">
                                        <div class="pull-left">
                                        <h4>Description:{{$iep->description}}</h4>
                                        <h4> Status :{{$iep->status}} </h4>
                                      </div>
                                        <div class="pull-right">
                                        <h5 >Goal Area:{{$iep->goal_area_description}}</h5>
                                        <h5 >Long Term Objective: {{$iep->lto_description}}</h5>

                                        <h5> Created At:<?php
                                         $mil=$iep->created_at->{'$date'}->{'$numberLong'};
                                         $seconds = $mil / 1000;
                                         echo date("F j, Y,", $seconds);
                                        ?></h5>
                                        </div>
                                      </div>

                                    </div>
                      @endforeach

                <?php } ?>

                <!--  -->
              </div>
            </div>
          </div>

        </div>

<hr/>
@endsection
