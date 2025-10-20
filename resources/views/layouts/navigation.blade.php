<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('restopasse.index') }}">
            <x-application-logo style="height: 36px;" />
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Left side links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Groupe Restaurant Dominical -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="restaurantDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Restaurant Dominical
                        @if(isset($repasAEvaluer) && $repasAEvaluer > 0)
                            <span class="badge bg-warning text-dark ms-1">{{ $repasAEvaluer }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="restaurantDropdown">
                        <li>
                            <x-dropdown-link :href="route('restopasse.index')" :active="request()->routeIs('restopasse.*')" class="dropdown-item">
                                {{ __('Resto passés') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('amange.index')" :active="request()->routeIs('amange.*')" class="dropdown-item">
                                {{ __('Mes repas (avis)') }}
                                @if(isset($repasAEvaluer) && $repasAEvaluer > 0)
                                    <span class="badge bg-warning text-dark ms-2">{{ $repasAEvaluer }}</span>
                                @endif
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.*')" class="dropdown-item">
                                {{ __('Restaurants') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('stats.index')" :active="request()->routeIs('stats.*')" class="dropdown-item">
                                {{ __('Les stats des copains') }}
                            </x-dropdown-link>
                        </li>
                    </ul>
                </li>

                <!-- Groupe Carnet d'adresse -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="carnetDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Carnet d'adresse
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="carnetDropdown">
                        <li>
                            <x-dropdown-link :href="route('avis.mes-avis')" :active="request()->routeIs('avis.mes-avis')" class="dropdown-item">
                                {{ __('Mes avis lieux') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('lieux.index')" :active="request()->routeIs('lieux.*')" class="dropdown-item">
                                {{ __('Lieux') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link :href="route('types.index')" :active="request()->routeIs('types.*')" class="dropdown-item">
                                {{ __('Types') }}
                            </x-dropdown-link>
                        </li>
                    </ul>
                </li>

                <!-- Groupe Admin -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li>
                            <x-dropdown-link :href="route('copains.index')" :active="request()->routeIs('copains.*')" class="dropdown-item">
                                {{ __('Copains') }}
                            </x-dropdown-link>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Right side dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="dropdown-item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
