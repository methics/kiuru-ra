<nav class="navbar navbar-expand-md navbar-methics fixed-top">
    <!--<a class="navbar-brand" href="/"><img src="https://www.methics.fi/wp-content/uploads/2013/06/cropped-l_methics_shadow2.png"></a>-->
    <a class="navbar-brand" href="/"><img src="{{asset('images/methics_logo.png')}}"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/registration">Registration</a>
            </li>
            <li>
                <a class="nav-link" href="/lookup">Lookup</a>
            </li>

            @role("kiuru-ra-admin")
                <li>
                    <a class="nav-link" href="/users">Admin</a>
                </li>
                <li>
                    <a class="nav-link" href="/logs/all">Logs</a>
                </li>
            @endrole
        </ul>
        @auth
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                        @endguest

                        @auth
                            {{Auth::user()->name}}
                        @endauth
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route("logout") }}">Logout</a>
                    </div>
                </li>

            </ul>
        @endauth

        @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        @endguest

    </div>
</nav>