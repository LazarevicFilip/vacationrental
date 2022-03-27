@extends("layouts.front")
@section("title")
    Vacation Rental - Profile
@endsection

@section("content")
    @include("fixed.front.tabs")
    <div class="container my-5">
        <div class="row">
           <div class="col-md-12 text-center">
               <form action="{{route("changePassword")}}" method="post">
                   @csrf
                   <input type="hidden" name="email" value="{{session("user")->email}}">
                   <div class="form-group col-md-6 mx-auto">
                       <label for="password">Trenutna lozinka</label>
                       <input type="password" class="form-control" value="{{old("password") ? old("password") : ""}}" name="password">
                       @error("password") <p class="alert-danger">{{$message}}</p> @enderror
                   </div>
                   <div class="form-group col-md-6 mx-auto">
                       <label for="newPassword">Nova lozinka</label>
                       <input type="password" class="form-control" name="newPassword">
                       @error("newPassword") <p class="alert-danger">{{$message}}</p> @enderror
                   </div>
                   <div class="form-group col-md-6 mx-auto">
                       <label for="confirmPassword">Potvrdite novu lozinku</label>
                       <input type="password" class="form-control" name="confirmPassword">
                       @error("confirmPassword") <p class="alert-danger">{{$message}}</p> @enderror
                   </div>
                   <input type="submit" name="btnChange" class="btn btn-primary" value="Potvrdi" />
               </form>
              <div class="col-md-6 mx-auto text-center mt-3">
                  @if(session("msg"))
                      <div class="{{session("class")}}">
                          <strong>{{session("msg")}}</strong>
                      </div>
                  @endif
              </div>
           </div>
        </div>
    </div>

@endsection

@section("scripts")
    @include("fixed.front.scripts")
@endsection
