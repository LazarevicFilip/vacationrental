<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InsertUserThroughAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data["users"] = User::all();
    }
    public function index()
    {
        return view("pages.back.usersAll", ["users" => $this->data["users"]]);
    }
    public function create()
    {
        return view("pages.back.createUser");
    }

    public function store(InsertUserThroughAdmin $request)
    {
        try {
            $data = $request->only("name", "email", "phone", "role", "password");
            $data["password"] = Hash::make($data["password"]);
            $user = new User();
            $user->update($data);

            $request->session()->put("user", $user);
            return redirect()->back()->with(["msg" => "Uspesna ste dodali novog korisnika.", "class" => "alert alert-success"]);


        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Email/Telefon koji ste uneli je vec iskoriscen", "class" => "alert alert-danger"]);
        }
    }
}
