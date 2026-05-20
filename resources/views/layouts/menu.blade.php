<header class="header">
    <div class="menu">

        <div class="logo">
            <!--Logo-->
            <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>

        @guest
        <ul class="d-flex">
            <li class="me-2"><a href="{{ route('login') }}" class="login">Acceder</a></li>
            <li><a href="{{ route('register') }}" class="create">Crear cuenta</a></li>
        </ul>

        @else
        <div class="dropdown">
            <input type="checkbox" id="dropdown-toggle-checkbox" class="dropdown-checkbox">
            <label for="dropdown-toggle-checkbox" class="dropdown-toggle">
                <img src="{{ Auth::user()->profile && Auth::user()->profile->photo 
                    ? asset('storage/' . Auth::user()->profile->photo)
                    : asset('img/user-default.png') }}" 
                    alt="Profile" class="img-profile">
                <span class="name-user">{{ Auth::user()->full_name }}</span>
            </label>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}">Perfil</a></li>

                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Ir al admin</a></li>
                
                <li>
                    <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">Salir</a>
                </li>
            </ul>
        </div>
        @endguest
        </nav>
    </div>

</header>

<script>
// Cerrar al hacer clic en cualquier lado de la pagina
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown');
    const checkbox = document.getElementById('dropdown-toggle-checkbox');
    
    if (!dropdown.contains(event.target)) {
        checkbox.checked = false;
    }
});

// Cerrar al hacer clic en un item del dropdown
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        document.getElementById('dropdown-toggle-checkbox').checked = false;
    });
});
</script>