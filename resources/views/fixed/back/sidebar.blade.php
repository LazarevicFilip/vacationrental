<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="{{route("dashboard")}}"><i class="menu-icon fa-solid fa-table-columns"></i>Pregled
                </a></li>
            <li><a href="{{route("users.index")}}"><i class="menu-icon fa-solid fa-user"></i>Upravljaj korisnicima</a>
            </li>
            <li><a href="{{route("locations.index")}}"><i class="menu-icon fa-solid fa-location-pin"></i>Upravljaj lokacijama
                         </a></li>
            <li><a href="{{route("categories.index")}}"><i class="menu-icon fa-solid fa-dice-five"></i>Upravljaj kategorijama
                     </a></li>
            <li><a href="{{route("venues.index")}}"><i class="menu-icon fa-solid fa-house"></i>Upravljaj oglasima
                      </a></li>
        </ul>
        <!--/.widget-nav-->


        <!--/.widget-nav-->
        <ul class="widget widget-menu unstyled">
            <li><a href="#"><i class="menu-icon icon-signout"></i>Logout </a></li>
            <li><a href="{{route("logout")}}"><i class="menu-icon fa-solid fa-arrow-right-from-bracket"></i>Odjavi se</a></li>
        </ul>
    </div>
    <!--/.sidebar-->
</div>
