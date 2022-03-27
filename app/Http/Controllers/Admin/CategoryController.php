<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewCategoryOrLocationRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data["categories"] = Category::all();
    }
    public function index(){
        return view("pages.back.categoriesAll",$this->data);
    }
    public function create(){
        return view("pages.back.createCategory");
    }
    public function store(NewCategoryOrLocationRequest $request){
        try {
            $data = $request->only("name","photo_path");
            $image = $data["photo_path"];
            if($image){
                $newImageName = time()."_". $image->getClientOriginalName();
                $image->move(public_path("assets/images/"),$newImageName);
            }
            Category::create([
                "name" => $data["name"],
                "photo_path" => $newImageName
            ]);
            return redirect()->back()->with(["msg" => "Uspesna ste dodali novu kategoriju.", "class" => "alert alert-success"]);
        }catch (\Throwable $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Doslo je do greske prilikom obrade vaseg zahteva.", "class" => "alert alert-danger"]);
        }
    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        try {
            if(File::exists(public_path("assets/images/".$category->photo_path))){
                File::delete(public_path("assets/images/".$category->photo_path));
            }
            $category->delete();
            return redirect()->back()->with(["msg" => "Uspesna ste obrisali kategoriju.", "class" => "alert alert-success"]);
        }
        catch (\Throwable $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Nije moguce obrisati ketegoriju jer postoje oglasi koji joj pripadaju.", "class" => "alert alert-danger"]);
        }
    }
}
