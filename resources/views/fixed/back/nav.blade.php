<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i>
            </a>

            <a class="brand" href="{{route("home")}}">
                Vacation<span class="logo">Rental</span>
            </a>

            <div class="nav-collapse collapse navbar-inverse-collapse">

                <ul class="nav pull-right">
                    @foreach($menus as $menu)
                        <li class="nav-item"><a href="{{route($menu->route)}}" class="nav-link">{{$menu->name}}</a></li>
                    @endforeach
                    @if(request()->routeIs("login"))
                        <li><a href="{{route("register")}}">
                                Registuj se
                            </a></li>
                    @elseif(request()->routeIs("register"))
                        <li><a href="{{route("login")}}">
                                Prijavi se
                            </a></li>
                    @elseif(request()->is("admin/*"))
                        <li><a href="">Admin: {{session("user")->name}} </a></li>
                    @endif
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->
