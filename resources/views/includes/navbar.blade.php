<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            @if (request()->route()->getName() == 'register')
                <li><a href="{{ route('login') }}">Login</a></li>

            @endif
            @if (request()->route()->getName() == 'login')
                <li><a href="{{ route('register') }}">Register</a></li>
            @endif

            @if (auth()->check())
            <li><form method="post" action="{{ route('auth.logout') }}">
                @csrf
                <button>Logout</button>
            </form></li>
            <li><a href="{{route('team.index')}}">Team List</a></li>
            <li><a href="{{route('player.index')}}">Player List</a></li>
            @endif
        </ul>
    </div>
</nav>
