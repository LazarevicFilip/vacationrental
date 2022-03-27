<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-fill">
                @if(session()->has("user"))
                    @foreach($tabs as $tab)
                        @if((session()->get("user")->role->name == "Prodavac") || (session()->get("user")->role->name == "Admin"))
                            @if($tab->route == "oglasi")
                                <li class="nav-item border @if(request()->routeIs("oglasi")) border-secondary font-weight-bold @endif">
                                    <a class="nav-link text-dark" href="{{route($tab->route,["id" => session()->get("user")->id])}}">{{$tab->name}}</a>
                                </li>
                            @else
                                <li class="nav-item  border @if(request()->routeIs($tab->route)) border-secondary font-weight-bold @endif">
                                    <a class="nav-link text-dark " href="{{route($tab->route)}}">{{$tab->name}}</a>
                                </li>
                            @endif
                        @elseif( (session()->get("user")->role->name == "Kupac") && $tab->show == 0)
                            <li class="nav-item  border @if(request()->routeIs($tab->route)) border-secondary font-weight-bold @endif">
                                <a class="nav-link text-dark " href="{{route($tab->route)}}">{{$tab->name}}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
