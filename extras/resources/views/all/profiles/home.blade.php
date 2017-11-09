@extends('dashboard_layout')
@section('page_heading','My Profile')

@section('section')



<?php
$json=json_decode($user);
?>

@section('section')
<?php

if(!(isset($json->profile_info) && !empty($json->profile_info)) )
{ ?>
  <br/><br/>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-danger">
                  <div class="panel-heading"><span class="glyphicon glyphicon-warning-sign">&nbsp;</span>No Information found</div>

                  <div class="panel-body">
                      <p>No Profile Information has been added to the User</p><br/>
                      <div class="models--actions">
                          <a class="btn btn-labeled btn-success" href="{{route('profile.create')}}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add Info'}}</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
<?php }
else {
  $data=$json->profile_info;
  \Debugbar::info(Carbon\Carbon::parse($user->created_at)->format('F j, Y'));
  ?>
  <div class="container">
    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
              <h3 class="panel-title">Profile Information</h3>
          </div>
          <div class="panel-body">
            <div class="row">
                  <div class=" col-md-6 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr><td>Name</td><td>{{Auth::user()->name}}</td></tr>
                        <tr><td>Email</td><td>{{Auth::user()->email}}</td></tr>
                        <tr><td>Date Of Birth</td><td>{{$data->date_of_birth}}</td></tr>
                        <tr><td>Age</td><td>
                          <?php
                          $value = str_replace('/', '-', $data->date_of_birth);
                          $from = new DateTime(date("Y-m-d", strtotime($value)));
                          $to   = new DateTime();
                          $interval=$from->diff($to);
                          echo $interval->format("%Y ");
                           ?>
                        </td></tr>
                        <tr><td>Date Of Joining</td><td>{{$data->date_of_joining}}</td></tr>
                        <tr><td>Gender</td><td>{{$data->gender}}</td></tr>

                      </tbody>

                    </table>

                  </div>
                  <div class="col-md-6">

                          <div class="panel panel-default">
                            <div class="panel-heading">Address</div>
                            <div class="panel-body">
                              <address>
                                <strong>{{$data->Address->Line1}}</strong><br>
                                {{$data->Address->Line2}}<br>
                                {{$data->Address->City}}<br>
                                {{$data->Address->State}},{{$data->Address->Country}}<br>
                                <abbr title="Phone">Ph:</abbr> {{$data->Address->Land_Phone}}<br/>
                                <abbr title="Mob">Mob:</abbr>{{$data->Address->Mobile_Number}}
                              </address>
                            </div>
                          </div>

                  </div>
                </div>
          </div>
          <div class="panel-footer">
                 <a class="btn btn-labeled btn-success" href="{{route('profile.edit',1)}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ 'edit' }}</a>
                 <span class="pull-right">
                   <form action="{{route('profile.destroy',1)}}" method="post" class="delete">
                     <input type="hidden" name="_method" value="DELETE" />
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                     <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ 'delete' }}</button>
                    </form>
                 </span>
          </div>
      </div>
    </div>
    </div>
  </div>

<?php

}
?>

@endsection
