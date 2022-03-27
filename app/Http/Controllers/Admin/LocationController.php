<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewCategoryOrLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data["locations"] = Location::all();
    }
    public function index(){
        return view("pages.back.locationsAll",$this->data);
    }
    public function create(){
       return view("pages.back.createLocation");
    }
    public function store(NewCategoryOrLocationRequest $request){
        try {
            $data = $request->only("name","photo_path");
            $image = $data["photo_path"];
            if($image){
                $newImgName = time() . "_".$image->getClientOriginalName();
                $image->move(public_path("assets/images/"),$newImgName);
            }
            Location::create([
                "name" => $data["name"],
                "photo_path" => $newImgName
            ]);
            return redirect()->back()->with(["msg" => "Uspesna ste dodali novu lokaciju.", "class" => "alert alert-success"]);
        }catch (\Throwable $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Doslo je do greske prilikom obrade vaseg zahteva.", "class" => "alert alert-danger"]);
        }
    }
    public function destroy($id){
        $location = Location::findOrFail($id);
        try {
            if(File::exists(public_path("assets/images/".$location->photo_path))){
                File::delete(public_path("assets/images/".$location->photo_path));
            }
                $location->delete();
            return redirect()->back()->with(["msg" => "Uspesna ste obrisali lokaciju.", "class" => "alert alert-success"]);
        }catch (\Throwable $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Nije moguce obrisati lokaciju jer postoje oglasi koji joj pripadaju.", "class" => "alert alert-danger"]);
        }
    }
}
