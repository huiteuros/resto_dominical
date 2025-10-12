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
                <li class="nav-item">
                    <x-nav-link :href="route('restopasse.index')" :active="request()->routeIs('restopasse.*')" class="nav-link">
                        {{ __('Resto passés') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('amange.index')" :active="request()->routeIs('amange.*')" class="nav-link">
                        {{ __('Mes repas (avis)') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('avis.mes-avis')" :active="request()->routeIs('avis.mes-avis')" class="nav-link">
                        {{ __('Mes avis lieux') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('stats.index')" :active="request()->routeIs('stats.*')" class="nav-link">
                        {{ __('Les stats des copains') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.*')" class="nav-link">
                        {{ __('Restaurants') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('copains.index')" :active="request()->routeIs('copains.*')" class="nav-link">
                        {{ __('Copains') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('lieux.index')" :active="request()->routeIs('lieux.*')" class="nav-link">
                        {{ __('Lieux') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('types.index')" :active="request()->routeIs('types.*')" class="nav-link">
                        {{ __('Types') }}
                    </x-nav-link>
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
