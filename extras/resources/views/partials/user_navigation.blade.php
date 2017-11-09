
        <li class="{{ (Request::is('*users*') ? 'active': '')}}"><a href="{{ route('users.index')}}">users</a></li>
        <li class="{{ (Request::is('*roles*') ? 'active': '')}}"><a href="{{ route('roles.index')}}">roles</a></li>
        <li class="{{ (Request::is('*permissions*') ? 'active': '')}}"><a href="{{ route('permissions.index')}}">permissions</a></li>
