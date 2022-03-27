<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col d-flex align-items-center">
                <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+00 1234 567</a> or <span
                        class="mailus">email us:</span> <a href="#"><span class="__cf_email__"
                                                                          data-cfemail="e58088848c89968488958980a58088848c89cb868a88">[email&#160;protected]</span></a>
                </p>
            </div>

        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route("home")}}">Vacation<span>Rental</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                @foreach($menus as $menu)
                    <li class="nav-item @if(request()->routeIs($menu->route)) active @endif "><a href="{{route($menu->route)}}" class="nav-link">{{$menu->name}}</a></li>
                @endforeach
                @if(!session()->get("user"))
                    <li class="nav-item"><a href="{{route("login")}}" class="nav-link">Login</a></li>
                @elseif(session()->get("user"))
                    <li class="nav-item"><a href="{{route("profile")}}" class="nav-link">Profil</a></li>
                    <li class="nav-item"><a href="{{route("logout")}}" class="nav-link">Odjavi se</a></li>
                @endif
                @if(session()->has("user") && session()->get("user")->role->name == "Admin")
                        <li class="nav-item"><a href="{{route("dashboard")}}" class="nav-link">Admin</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
