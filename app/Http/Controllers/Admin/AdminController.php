<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VenueController;
use App\Http\Requests\InsertUserThroughAdmin;
use App\Models\AdditionalContent;
use App\Models\Category;
use App\Models\Location;
use App\Models\Price;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data["categories"] = Category::all();
        $this->data["additional"] = AdditionalContent::all();
        $this->data["users"] = User::all();
        $this->data["venues"] = Venue::all();
        $this->data["locations"] = Location::all();
        $this->data["prices"] = Price::all();
    }

    public function index()
    {
        return view("pages.back.admin", $this->data);
    }
    public function venues(){
        return view("pages.back.venuesAll",["venues" => $this->data["venues"]]);
    }
    public function create(){
        return view("pages.back.createVenue",[
           "categories" => $this->data["categories"],
            "additional_content" => $this->data["additional"],
            "locations" => $this->data["locations"],
            "venues" => $this->data["venues"],
        ]);
    }
    public function destroy(Request $request)
    {
        if(!$request->has("id")){
            abort(404);
        }
        try {
            $id = $request->get("id");
            $venue = Venue::findOrFail($id);
            $con = new VenueController();
            DB::beginTransaction();
            $con->deleteImages($id);
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
            return redirect()->back()->with(["msg"=> "Uspesno ste izbrisali zapis.","class"=>"alert alert-success"]);
        }catch (\Throwable $ex){
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg"=> "Doslo je do greske prilikom obrade vaseg zahteva.","class"=>"alert alert-danger"]);
        }
    }
    public function banUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->get("user"));
            $msg = "";
            if ($user->is_banned) {
                $user->is_banned = "0";
                $msg = "Korisnik je ponovo aktivan.";
            } else {
                $user->is_banned = "1";
                $msg = "Korsinik je banovan.";
            }
            $user->save();
            return redirect()->back()->with(["msg" => $msg, "class" => "alert alert-success"]);
        } catch (\Throwable $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Trenutno ne mozemo da obradimo vaz zahtev", "class" => "alert alert-danger"]);
        }
    }
}
