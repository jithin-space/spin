@extends('layouts.app')

@section('page')
<div id="page-wrapper">
   <div class="row">
     <div class="col-lg-12">
         <h1 class="page-header">@yield('page_heading')</h1>
     </div>
   </div>
   <div class="row">
     @yield('section')
   </div>

</div>
@endsection
