@extends("layouts.backend")
@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                @if(session("msg"))
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <p class="{{session("class")}}">{{session("msg")}}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @include("fixed.back.sidebar")
                <div class="span8">
                    <form method="post" action="{{route("vikendice.store")}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{session("user")->id}}">
                        <div class="module-body">
                            <div class="control-group ">
                                <label for="name">Naziv objekta:</label>
                                <input type="text" class="span12" name="name" value="{{old("name") ? old("name") : ""}}">
                                @error("name")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group ">
                                <label for="address">Adresa:</label>
                                <input type="text" class="span12" name="address" value="{{old("address") ? old("address") : ""}}">
                                @error("address")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group col-md-2">
                                <label for="square_footage">Povrsina(m<sup>2</sup>):</label>
                                <input type="text" class="span12" name="square_footage" value="{{old("square_footage") ? old("square_footage") : ""}}">
                                @error("square_footage")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <label for="categories">Kategorije:</label>
                                <select class="span12" title="Izaberite" name="categories[]" multiple>
                                    @foreach($categories as $category)
                                        @if(in_array($category->id,old("categories") ? old("categories") : []))
                                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error("categories")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group">
                                <label for="additional">Dodatni sadrzaj:</label>
                                <select class="span12" title="Izaberite" name="additional[]" multiple>
                                    @foreach($additional_content as $ac)
                                        @if(in_array($ac->id,old("additional") ? old("additional"):[]))
                                            <option selected value="{{$ac->id}}">{{$ac->name}}</option>
                                        @else
                                            <option value="{{$ac->id}}">{{$ac->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error("additional")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group">
                                <label for="location_id">Lokacija:</label>
                                <select name="location_id"  class="span12">
                                    <option value="0">Izaberite...</option>
                                    @foreach($locations as $location)
                                        @if($location->id == old("location_id"))
                                            <option selected value="{{$location->id}}">{{$location->name}}</option>
                                        @else
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error("location_id")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <label for="max_guests">Broj gostiju:</label>
                                <input type="text" class="span12" name="max_guests" value="{{old("max_guests") ? old("max_guests") : ""}}">
                                @error("max_guests")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group ">
                                <label for="num_rooms">Broj soba:</label>
                                <input type="text" class="span12" name="num_rooms" value="{{old("num_rooms") ? old("num_rooms") : ""}}">
                                @error("num_rooms")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group">
                                <label for="num_wc">Broj kupatila:</label>
                                <input type="text" class="span12" name="num_wc" value="{{old("num_wc") ? old("num_wc") : ""}}">
                                @error("num_wc")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group">
                                <label for="num_beds">Broj kreveta:</label>
                                <input type="text" class="span12" name="num_beds" value="{{old("num_beds") ? old("num_beds") : ""}}">
                                @error("num_beds")<p class=" alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="description">Opis objekta:</label>
                            <textarea class="span12 module"   name="description" cols="10" rows="4">{{old("description") ? old("description") : ""}}</textarea>
                            @error("description")<p class="alert-danger">{{$message}}</p> @enderror
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <label for="photos">Dodajte slike:</label>
                                <input type="file"   id="file" name="photos[]" multiple />
                                @error("photos")<p class="alert-danger">{{$message}}</p> @enderror
                                @error("photos.*")<p class=" alert-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="control-group ">
                                <label for="price">Cena po nocenju(&euro;):</label>
                                <input type="text" class="span12" name="price" id="price" value="{{old("price")? old("price") : ""}}">
                                @error("price")<p class="alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <input type="submit"  value="Posalji" class="btn btn-primary " />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section("scripts")
    @parent
    <script src="{{asset("assets/js/admin/common.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/admin/jquery.dataTables.js")}}" type="text/javascript"></script>
@endsection
