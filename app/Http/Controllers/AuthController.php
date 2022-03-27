<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\InsertUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Menu;
use App\Models\Tab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $tabs;

    public function __construct()
    {
        $this->tabs =  Tab::all();
    }

    public function registerForm(){
        return view("pages.front.register");
    }
    public function register(InsertUserRequest $request)
    {
        try {
            $data = $request->only("nameUI", "emailUI", "phoneUI", "roleUI", "passwordUI");
            $user = new User();
            $user->name = $data["nameUI"];
            $user->phone = $data["phoneUI"];
            $user->email = $data["emailUI"];
            $user->password = Hash::make($data["passwordUI"]);
            $user->role_id = $data["roleUI"];

            $insert = $user->save();

            if ($insert) {
                $request->session()->put("user", $user);
                return response()->json(["msg" => "Uspesna registracija", "class" => "alert alert-success"]);
            }

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(["msg" => "Email/Telefon koji ste uneli je vec iskoriscen", "class" => "alert alert-danger"]);
        }
    }
    public function loginForm(){
        return view("pages.front.login");
    }
    public function login(LoginRequest $request)
    {
        try {
            $email = $request->get("email");
            $password = $request->get("password");

            $user = User::where("email", $email)->first();

            if (!$user) {
                return redirect()->back()->withInput()->with("err", "Ne postoji korisnik sa zadatom email adresom");
            }
            if ($user->is_banned) {
                return redirect()->back()->withInput()->with("err", "Vas nalog je banovan.Kontaktirajte administratora za dalje informacje.");
            }

            if (Hash::check($password, $user->password)) {
                $request->session()->put("user", $user);
                return redirect()->route("profile");
            } else {
                return redirect()->back()->withInput()->with("err", "Lozinka/email se ne poklapaju");
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with("err", "Trenutno ne mozemo da obradimo vas zahtev");
        }
    }
    public function profile(){
        return view("pages.front.profile",["tabs" => $this->tabs]);
    }
    public function changePasswordForm()
    {
        return view("pages.front.change_password",["tabs" => $this->tabs]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::where("email", $request->get("email"))->first();

            if (Hash::check($request->get("password"), $user->password)) {
                $user->password = Hash::make($request->get("newPassword"));
                $user->save();
                return redirect()->back()->with(["msg" => "Uspesno ste promenili lozinku", "class" => "alert alert-success"]);
            } else {
                return redirect()->back()->with(["msg" => "Uneli ste pogresnu lozinka", "class" => "alert alert-danger"]);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with(["msg" => "Doslo je do greske priliko obrade vaseg zahteva", "class" => "alert alert-danger"]);
        }
    }
    public function logout(Request $request)
    {
        if ($request->session()->has("user")) {
            $request->session()->forget("user");
            return redirect()->route("login");
        }
    }
}
