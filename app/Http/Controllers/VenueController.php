<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\VenueRequest;
use App\Models\AdditionalContent;
use App\Models\Category;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Price;
use App\Models\Reservation;
use App\Models\Tab;
use App\Models\User;
use App\Models\Venue;
use App\Rules\UniqueDateForVenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class VenueController extends FrontController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
//        when pagination links are clicked,return json
        if($request->has("page")) {
            return response()->json([
                "items" => $this->venues->get($request)->items
            ]);
        }
        //initial return view
        $queryString = $request->all();
        return view("pages.front.venues",[
            "locations" => $this->locations->get(),
            "venues" => $this->venues->get($request)->items,
            "pagesCount" => $this->venues->get($request)->pagesCount,
            "categories" =>   $this->categories->get(),
            "queryString" => $queryString,
        ]);
    }

    public function create()
    {
        return view("pages.venues.create",[
            "locations" => $this->locations->get(),
            "categories" => $this->categories->get(),
            "additional_content" => AdditionalContent::all(),
            "tabs" => Tab::all()
        ]);
    }

    public function store(VenueRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $venueDate = $request->except("categories","additional","photos","price");
            $venue =  Venue::create($venueDate);
            $this->storeImages($data["photos"],$venue);
            $venue->categories()->sync($request->get("categories"));
            $venue->additional_contents()->sync($request->get("additional"));
            Price::create([
               "price" => $request->get("price"),
               "venue_id" => $venue->id
            ]);
            DB::commit();
            return redirect()->back()->with(["msg"=>"Uspesno ste napravili oglas.","class"=>"alert alert-success"]);
        }catch (\Exception $ex){
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg"=>"Doslo je do greske pri obradjivanju vaseg zahteva.","class"=>"alert alert-danger"]);
        }
    }


    public function show($id)
    {
        $venue = new \stdClass();
        $venue->item = $this->venues->getOne($id);
        $venue->photos = $this->venues->getVenueImages($id);
        $venue->categories = $this->venues->getVenueCategories($id);
        $venue->additionalContents = $this->venues->getVenueAdditionalContent($id);
        $venue->relatedObjects = $this->venues->getRelatedObjcets($id);
        $venue->venueOwner = $this->venues->getVenueOwner($id);

        return view("pages.front.venue_details",["venue"=>$venue]);
    }


    public function edit($id)
    {
        $venue = Venue::findOrFail($id);
        return view("pages.venues.edit",
            [
                "venue"=>$venue,
                "categories" => Category::all(),
                "additional_content" => AdditionalContent::all(),
                "locations" => Location::all(),
                "tabs" => Tab::all()
            ]);
    }

    public function update(VenueRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $venue = Venue::findOrFail($id);
            $data = $request->validated();
            if(isset($data["photos"])) {
                $this->storeImages($data["photos"], $venue);
            }
            $venueDate = $request->except("categories","additional","photos","price");
            $venue->update($venueDate);
            $venue->categories()->sync($request->get("categories"));
            $venue->additional_contents()->sync($request->get("additional"));
            Price::where("venue_id",$id)->update([
                "price" => $request->get("price"),
                "venue_id" => $venue->id
            ]);
            DB::commit();
            return redirect()->back()->with(["msg"=>"Uspesno ste izmenili oglas.","class"=>"alert alert-success"]);
        }catch (\Exception $ex){
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg"=>"Doslo je do greske pri obradjivanju vaseg zahteva.","class"=>"alert alert-danger"]);
        }
    }

    public function destroy($id)
    {
        try {
            $venue = Venue::find($id);
            $user = $venue->user_id;
            if(!$venue){
                return response()->json(["msg"=> "Oglas je nepostojeci.","class"=>"alert alert-danger"]);
            }
            DB::beginTransaction();
            $this->deleteImages($id);
            $venue->categories()->detach();
            $venue->additional_contents()->detach();
            foreach ($venue->photos as $photo){
                $photo->delete();
            }
            foreach ($venue->prices as $price){
                $price->delete();
            }
            $venue->delete();
            DB::commit();
            return response()->json(["venues"=>Venue::where("user_id",$user)->limit(5)->get(),"venuesCount"=>Venue::where("user_id",$user)->count(),"msg"=> "Uspesno obrisanno.","class"=>"alert alert-success"]);
        }catch (\Exception $ex){
            DB::rollBack();
            Log::error($ex->getMessage());
            return response()->json(["msg"=> "Doslo je do greske prilikom obrade vaseg zahteva.","class"=>"alert alert-danger"]);
        }
    }
    public function storeImages($images,Venue $venue){
        foreach ($images as $index=>$image){
            $newName = uniqid(). "_" . $image->getClientOriginalName();
            $image->storeAs("public/venues",$newName);
            $photo = new Photo();
            $photo->path = $newName;
            $photo->alt = $venue->name;
            $photo->venue_id = $venue->id;
            $photo->is_thumbnail = ($index == 4) ? "1" : "0";
            $photo->save();
        }
    }
    public function deleteImages($id){
        $images = Photo::where("venue_id",$id)->get();
        foreach ($images as $image){
            if(File::exists(public_path("storage/venues/".$image->path))){
                File::delete(public_path("storage/venues/".$image->path));
            }
        }
    }
    public function deleteImageWhenEditing($id){
        try {
            $photo = Photo::findOrFail($id);
            $photo->delete();
            if(File::exists(public_path("storage/venues/".$photo->path))){
                File::delete(public_path("storage/venues/".$photo->path));
            }
            return redirect()->back()->withInput();
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with("err" ,"Doslo je do greske prilikom obrade vaseg zahreva.");
        }
    }
    public function getUserVenues(Request $request,$id){
        if(!$request->session()->has("user")){
            abort(401);
        }
        if ($request->session()->get("user")->id != $id){
            abort(403);
        }
        $perPage =5;
        $venues = Venue::where("user_id",$id)->latest()->paginate($perPage);

        return view("pages.venues.user_venues",["venues"=>$venues,"tabs" => Tab::all()]);
    }
    public function reserveVenue(ReservationRequest $request){
        $data = $request->validated();
        try {
            Reservation::create($data);
            return redirect()->back()->with(["msg"=> "Uspesno ste napravili rezervaciju.Ocekujte poziv od vlasnika o svim dodatnim detaljima.","class"=>"alert alert-success"]);
        }catch (\Throwable $ex){
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg"=> "Doslo je do greske prilikom obrade vaseg zahteva.","class"=>"alert alert-danger"]);
        }
    }
    public function paginateTable(Request $request){
        $user = $request->session()->get("user")->id;
        $limit = 5;
        $offset = $request->get("page") * $limit;
        $venues =Venue::where("user_id",$user)->skip($offset)->take($limit)->get();
        return response()->json([
            "venues" =>$venues,
            "venuesCount" => Venue::where("user_id",$user)->count(),
            "tabs" => Tab::all()
        ]);
    }
}
