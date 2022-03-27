<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Menu;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends FrontController
{


    public function __construct()
    {
       parent::__construct();
    }
    public function index(Request $request){

        return view("pages.front.home",[
            "locations" => $this->locations->get(),
            "categories" =>   $this->categories->get(),
            "venues" => $this->venues->get($request)->items,
        ]);
    }
    public function author(){
        return view("pages.front.author");
    }
}
