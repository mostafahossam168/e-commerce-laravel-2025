<nav class="main-navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="logo">
            <div class="tog-active d-block d-lg-none" data-tog="true" data-active=".app">
                <i class="fas fa-bars"></i>
            </div>
            <img src="{{ asset('admin-asset/img/logo.png') }}" alt="logo" class="img">
        </div>

        <div class="d-flex align-items-center gap-2rem">

            @can('read_notifications')
                <a href="{{ route('admin.notifications') }}" class="main-btn btn-orange">
                    <span
                        class="main-badge navbar-notification">{{ auth()->user()->notifications()->unread()->count() }}</span>
                    الاشعارات
                    <i class="fa-solid fa-bell"></i>
                </a>
            @endcan
            {{-- <div class="dropdown">
                <button class="btn btn-light dropdown-toggle btn-sm px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }}
                </button>
                <ul class="dropdown-menu">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li><a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}


            <div class="dropdown info-user ms-auto">
                <button class="dropdown-toggle d-flex align-items-center gap-2 content" type="button"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text">
                        <div class="name">
                            <i class="fas fa-angle-down"></i>
                            {{ auth()->user()->name }}
                        </div>
                        <div class="dic">
                            {{ auth()->user()->type }}
                        </div>
                    </div>
                    <div class="img">
                        <img src="{{ asset('admin-asset/img/icons/user-black.svg') }}" alt="" class="icon" />
                    </div>
                </button>


                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @auth
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
