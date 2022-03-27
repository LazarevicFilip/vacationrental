<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = ["name","max_guests","num_rooms","num_wc","num_beds","description","address","square_footage","location_id","user_id"];
    public function categories(){
        return $this->belongsToMany(Category::class,"venues_categories");
    }
    public function additional_contents(){
        return $this->belongsToMany(AdditionalContent::class,"additional_contents_venues");
    }
    public function prices(){
        return $this->hasMany(Price::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function get($request)
    {
        $query = DB::table("venues as v")
            //join price and photo table
            ->join("prices", "v.id", "=", "prices.venue_id")
            ->join("photos as p", "v.id", "=", "p.venue_id");
        //get only the main image/thumbnail image
        $query = $query->where("p.is_thumbnail", "=", "1");
        //select column for projecting
        $query = $query->select("v.*", "p.path as path", "prices.price");
        //filter by location
        if ($request->has("location") && $request->get("location") != null) {
            $query = $query->where("v.location_id", "=", $request->get("location"));
        }
        //filter by categories
        if ($request->has("category") && $request->get("category") != null) {
            //join with the pivot table
            $query = $query->join("venues_categories as vc", "v.id", "=", "vc.venue_id")
                ->where("vc.category_id", "=", $request->get("category"));
        }
        //filter by rooms
        if ($request->has("rooms") && $request->get("rooms") != null) {
            $query = $this->checkNumberOfRooms($request, "rooms", $query, "v.num_rooms");
        }
        //filter by bathrooms
        if ($request->has("bathrooms") && $request->get("bathrooms") != null) {
            $query = $this->checkNumberOfRooms($request, "bathrooms", $query, "v.num_wc");
        }
        //filter by guest
        if ($request->has("guests") && $request->get("guests") != null) {
            //if it is case with + sign
            if ($request->get("guests") == "10+") {
                $query = $query->where("max_guests", ">", $request->get("guests"));
            } else {
                //interval case 0-2 etc..
                $guests = explode("-", $request->get("guests"));
                $query = $query->whereBetween("max_guests", [$guests[0], $guests[1]]);
            }
        }
        if ($request->has("price") && $request->get("price") != null) {
            //if it is case with + sign
            if ($request->get("price") == "200+") {
                $query = $query->where("price", ">", 200);
            } else {
                $query = $query->where("price", "<=", $request->get("price"));
            }
        }
        if($request->has("keyword") && $request->get("keyword") != null){
            $query = $query->where("v.name","LIKE","%".$request->get("keyword")."%");
        }
        $perPage = 6;
        if($request->has("perPage") && $request->get("perPage") != null){
            $perPage =  $request->get("perPage");
        }

        if ($request->has("page")) {
            $offset = $perPage * $request->get("page");
            $query = $query->skip($offset);
        }
        $query = $query->take($perPage);
        $obj = new \stdClass();
        $obj->pagesCount = ceil($query->count() / $perPage);
        $obj->items = $query->get();
        return $obj;
    }

    //function for filtering by rooms/bathrooms
    public function checkNumberOfRooms($request, $room, $query, $column)
    {
        //check for if it is 5+ rooms/bathrooms case
        $value = strlen($request->get($room));
        //normal case
        if ($value == 1) {
            $query = $query->where($column, "=", $request->get($room));
            // 5+ case
        } else if ($value == 2) {
            $query = $query->where($column, ">=", 5);
        }
        return $query;
    }

    public function getOne($id)
    {
        return DB::table("venues as v")
            //join price and photo table
            ->join("prices", "v.id", "=", "prices.venue_id")
            ->select("v.*", "prices.price")
            ->where("v.id", "=", $id)->first();

    }

    public function getVenueCategories($id)
    {
        return DB::table("venues_categories as vc")
            ->select("c.name as category", "c.id as categoryId")
            ->join("categories as c", "vc.category_id", "=", "c.id")
            ->where("vc.venue_id", "=", $id)->get();
    }

    public function getVenueImages($id)
    {
        return DB::table("photos")
            ->select("path", "venue_id as VID", "is_thumbnail")
            ->where("venue_id", "=", $id)->get();
    }

    public function getVenueAdditionalContent($id)
    {
        return DB::table("additional_contents_venues as a")
            ->join("additional_contents as ac", "a.additional_content_id", "=", "ac.id")
            ->where("a.venue_id", "=", $id)
            ->select("ac.name")->get();
    }

    public function getRelatedObjcets($id)
    {
        $locationId = DB::table("venues")->find($id)->location_id;
        return DB::table("venues as v")
            ->join("prices as p", "v.id", "=", "p.venue_id")
            ->join("photos as ph", "v.id", "=", "ph.venue_id")
            ->where("ph.is_thumbnail", "=", "1")
            ->where("v.location_id", $locationId)
            ->select("v.*", "p.price","ph.path")
            ->get();
    }
    public function getVenueOwner($id){
        return DB::table("venues as v")
            ->join("users as u","v.user_id","=","u.id")
            ->where("v.id","=",$id)
            ->select("u.phone","u.name","u.email","u.id")->first();
    }

}
