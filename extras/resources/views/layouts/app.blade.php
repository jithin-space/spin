@extends('layouts.plane')

@section('body')

<div id="wrapper">

       <!-- Navigation -->
       <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{ url('/home') }}">SPIN-IEP v1.0 | Laravel 5</a>
           </div>


           <ul class="nav navbar-top-links navbar-right">
             @if(0)
             <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-messages">
                 <li> task 1 </li>
                 <li> task 1 </li>
                 <li> task 1 </li>

               </ul>
             </li>
             <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-tasks">
                 <li> task 1 </li>
                 <li> task 1 </li>
                 <li> task 1 </li>
               </ul>

             </li>
             <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-alerts">
                 <li> on progress </li>
                 <li> task 1 </li>
                 <li> task 1 </li>
               </ul>
             </li>
             @endif
             <li><a href="{{ url ('/home') }}"><i class="fa fa-home fa-fw"></i> {{ Auth::user()->name }}</a></li>
             <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
               </a>
               <ul class="dropdown-menu dropdown-user">
                 <li class="dropdown">
                     <a href="#" >
                         {{ Auth::user()->name }} <span class="caret"></span>
                     </a>
                  </li>
                 <li><a href="{{ route('profile.show', Auth::user()->id) }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                 </li>
                 <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> -->
                 </li>
                 <li class="divider"></li>
                 <li>
                   @if (Auth::guest())
                       <li><a href="{{ url('/login') }}">Login</a></li>
                       <li><a href="{{ url('/register') }}">Register</a></li>
                   @else

                     <a href="{{ url('/logout') }}"
                         onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                         <i class="fa fa-sign-out fa-fw"></i>Logout
                     </a>

                     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                     </form>
                    @endif
                 </li>
               </ul>

             </li>
           </ul>

           <!-- side bar -->
            @yield('sidebar')
         </nav>

         @yield('page')

</div>


@stop
