@extends("layouts.front")
@section("title")
    Vacation Rental - Profile
@endsection
@section("css")
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section("content")
    @include("fixed.front.tabs")
    @if(session("msg"))
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <p class="{{session("class")}}">{{session("msg")}}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form method="post" action="{{route("vikendice.update",["vikendice"=>$venue->id])}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="user_id" value="{{session("user")->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="name">Naziv objekta:</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{old("name") ? old("name") : $venue->name}}">
                            @error("name")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label for="address">Adresa:</label>
                            <input type="text" class="form-control" name="address"
                                   value="{{old("address") ? old("address") : $venue->address}}">
                            @error("address")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="square_footage">Povrsina(m<sup>2</sup>):</label>
                            <input type="text" class="form-control" name="square_footage"
                                   value="{{old("square_footage") ? old("square_footage") : $venue->square_footage}}">
                            @error("square_footage")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="categories">Kategorije:</label>
                            <select class="selectpicker form-control" title="Izaberite" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    @if(in_array($category->id,old("categories") ? old("categories") : $venue->categories()->pluck("category_id")->toArray()))
                                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error("categories")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="additional">Dodatni sadrzaj:</label>
                            <select class="selectpicker form-control" title="Izaberite" name="additional[]" multiple>
                                @foreach($additional_content as $ac)
                                    @if(in_array($ac->id,old("additional") ? old("additional"): $venue->additional_contents()->pluck("additional_content_id")->toArray()))
                                        <option selected value="{{$ac->id}}">{{$ac->name}}</option>
                                    @else
                                        <option value="{{$ac->id}}">{{$ac->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error("additional")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="location_id">Lokacija:</label>
                            <select name="location_id" class="form-control selectpicker">
                                <option value="0">Izaberite...</option>
                                @foreach($locations as $location)
                                    @if($location->id == $venue->location_id)
                                        <option selected value="{{$location->id}}">{{$location->name}}</option>
                                    @else
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error("location_id")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="max_guests">Broj gostiju:</label>
                            <input type="text" class="form-control" name="max_guests"
                                   value="{{old("max_guests") ? old("max_guests") : $venue->max_guests}}">
                            @error("max_guests")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="num_rooms">Broj soba:</label>
                            <input type="text" class="form-control" name="num_rooms"
                                   value="{{old("num_rooms") ? old("num_rooms") : $venue->num_rooms}}">
                            @error("num_rooms")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="num_wc">Broj kupatila:</label>
                            <input type="text" class="form-control" name="num_wc"
                                   value="{{old("num_wc") ? old("num_wc") : $venue->num_wc}}">
                            @error("num_wc")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="num_beds">Broj kreveta:</label>
                            <input type="text" class="form-control" name="num_beds"
                                   value="{{old("num_beds") ? old("num_beds") : $venue->num_beds}}">
                            @error("num_beds")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Opis objekta:</label>
                        <textarea class="form-control" name="description"
                                  rows="4">{{old("description") ? old("description") : $venue->description}}</textarea>
                        @error("description")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 mt-3 mx-auto">
                            <label for="photos">Dodajte slike:</label>
                            <input type="file" id="file" name="photos[]" multiple/>
                            @error("photos")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                            @error("photos.*")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="form-group col-md-3  mx-auto">
                            <label for="price">Cena po nocenju(&euro;):</label>
                            <input type="text" class="form-control" name="price" id="price"
                                   value="{{old("price")? old("price") : number_format($venue->prices()->orderByDesc("created_at")->first()->price,0)}}">
                            @error("price")<p class="mt-2 alert-danger">{{$message}}</p> @enderror
                        </div>
                    </div>
                    <input type="submit" value="Posalji" class="btn btn-primary w-100 mt-2 mb-5"/>
                </form>
            </div>
            <div class="col-md-8 offset-md-2 d-flex flex-wrap">
                @if(count($venue->photos) > 3)
                    @foreach($venue->photos as $photo)
                        <div>
                            <form action="{{route("deleteImageWhenEditing",["id"=>$photo->id])}}" class="form"
                                  method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="delete-image" value="&times;"/>
                                <img src="{{asset("storage/venues/".$photo->path)}}" width="220px" height="180px"
                                     alt="{{$photo->alt}}">
                            </form>
                        </div>
                    @endforeach
                @elseif(count($venue->photos) <= 3)
                    @foreach($venue->photos as $photo)
                        <div>
                            <img src="{{asset("storage/venues/".$photo->path)}}" class="ml-1" width="220px" height="180px"
                                 alt="{{$photo->alt}}">
                        </div>
                    @endforeach
                @endif
                    @if(count($venue->photos) <= 3)
                    <span class="my-2">Ne mozete izbrisati vise fotografija jer je minimum 3 po oglasu.</span>
                    @endif
            </div>
            <div class="col-md-6 offset-md-3">
                @if(session("err"))
                    <p class="aler aler-danger">{{session("err")}}</p>
                @endif
            </div>
        </div>
    </div>

@endsection


@section("scripts")

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@endsection

