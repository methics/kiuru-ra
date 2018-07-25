<nav class="navbar navbar-expand-md navbar-methics fixed-top">
    <a class="navbar-brand" href="#"><img src="https://www.methics.fi/wp-content/uploads/2013/06/cropped-l_methics_shadow2.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/registration">Registration</a>
            </li>
            <li>
                <a class="nav-link" href="/lookup">Lookup</a>
            </li>
            @if(Auth::check() && Auth::user()->isAdmin())
                <li>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
            @endif
        </ul>

    </div>
</nav>