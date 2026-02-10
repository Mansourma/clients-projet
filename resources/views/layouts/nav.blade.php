<style>

    .user-image {
        border-radius: 50%;
        object-fit: cover;
        width: 40px;
        height: 40px;
    }

    .navbar-toggler {
        border: none;
    }

    .dropdown-menu {
        background-color: #000;
        border: 1px solid #374151;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        color: #FBBF24; /* Tailwind's yellow-400 */
    }

    .dropdown-item:hover {
        color: #000;
        background-color: #FBBF24;
    }
</style>

<nav class="navbar navbar-expand-lg bg-gray-900 text-white" style="height: 55px;">
    <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">&#9776;</span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto flex items-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle flex items-center" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img src="{{ asset('storage/' . (Auth::user()->image ?? 'images/flat.jpg')) }}"
                        alt="User Image" class="user-image mr-2">
                    <span>{{ Auth::user()->name }} {{ Auth::user()->prenom }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdownMenuLink">
                    @php $userId = auth()->user()->id; @endphp
                    <a class="dropdown-item" href="{{ route('admins.show', $userId) }}">Profile</a>
                    <a class="dropdown-item logout-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
