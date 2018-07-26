<nav class="navbar navbar-expand-md navbar-methics fixed-top">
    <a class="navbar-brand" href="#"><img src="https://www.methics.fi/wp-content/uploads/2013/06/cropped-l_methics_shadow2.png"></a>
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
            @endrole



        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("logout") }}">Logout</a>
                </li>

            @endguest
        </ul>

    </div>
</nav>