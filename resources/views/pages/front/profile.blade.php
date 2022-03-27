@extends("layouts.front")
@section("title")
    Vacation Rental - Profile
@endsection

@section("content")
    @include("fixed.front.tabs")
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="my-3">Profil</h1>
                <div class="py-2 my-2 lead font-weight-bold">
                    Korisnik:  <span class="py-3 my-2  lead">{{session("user")->name}} </span>
                </div>
                <div class="py-2 my-2 lead font-weight-bold">
                    Email:  <span class="py-3 my-2  lead">{{session("user")->email}} </span>
                </div>
                <div class="py-2 my-2 lead font-weight-bold">
                    Korisnik od:  <span class="py-3 my-2  lead">{{session("user")->created_at}} </span>
                </div>
                <div class="py-2 my-2 lead font-weight-bold">
                    Telefon:  <span class="py-3 my-2  lead">{{session("user")->phone}} </span>
                </div>
                <div class="py-2 my-2 lead font-weight-bold">
                    Uloga:  <span class="py-3 my-2  lead">{{session("user")->role->name}} </span>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    @include("fixed.front.scripts")
@endsection
