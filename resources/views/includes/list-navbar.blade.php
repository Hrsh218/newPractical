<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            @if (auth()->check())
                <form method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button>Logout</button>
                </form>
                <li><a href="{{ route('team.index') }}">Team List</a></li>
                <li><a href="{{ route('player.index') }}">Player List</a></li>
                @if (request()->route()->getName() == 'player.index')
                    <li><a href="{{ route('player.create') }}">Player Create</a></li>
                @endif
            @endif
        </div>
    </div>
</nav>
