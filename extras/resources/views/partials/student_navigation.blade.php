<li class="{{ (Request::is('*students*') ? 'active': '')}}"><a href="{{ route('students.index')}}">students</a></li>
<li class="{{ (Request::is('*assign*') ? 'active': '')}}"><a href="{{ route('assign.index')}}">assign</a></li>
<li class=""><a href="">Manage</a></li>
