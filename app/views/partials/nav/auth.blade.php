<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="https://image.eveonline.com/Character/{{ Auth::id() }}_32.jpg" width="24" height="24" />
            {{ Auth::user()->name }}
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="/characters/{{ Auth::id() }}">My Deposits</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </li>
</ul>