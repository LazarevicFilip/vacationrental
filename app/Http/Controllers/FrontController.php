<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Menu;
use App\Models\Venue;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    protected $locations;
    protected $venues;
    protected $categories;

    public function __construct(){
        $this->locations = new Location();
        $this->venues = new Venue();
        $this->categories = new Category();
    }
}
