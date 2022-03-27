@extends("layouts.backend")
@section("content")
    <div class="wrapper">
        <div class="container">
        <div class="row">
            @include("fixed.back.sidebar")
            <div class="span8">
                <form action="{{route("users.store")}}" method="post" class="form-vertical span8" >
                    @csrf
                    <div class="module-head">
                        <h3>Novi korisnik</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="name">Ime i przime:</label>
                                <input class="span12" type="text" name="name" id="name" value="{{old("nameUI") ?? ""}}" placeholder="Marko Markovic">
                               @error("name") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="email">Email:</label>
                                <input class="span12" type="text" name="email" id="email" value="{{old("emailUI") ?? ""}}" placeholder="marko@gmail.com">
                                @error("email") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="phone">Telefon:</label>
                                <input class="span12" type="text" name="phone" id="phone" value="{{old("phoneUI") ?? ""}}" placeholder="06XXXXXXX">
                                @error("phone") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="ddl">Kupac/Prodavac</label>
                                <select class="span12" name="role" id="ddl">
                                    <option  value="0">Izaberite</option>
                                    <option  value="1">Administrator.</option>
                                    <option value="2">Kupac - moze da rezervise objekte.</option>
                                    <option value="3">Prodavac - moze da rezervise i postavlja svoje objekte.</option>
                                </select>
                                @error("role") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="password">Lozinka:</label>
                                <input class="span12" type="password" name="password" id="password" >
                                @error("password") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <label for="rePassword">Potvrdi Lozinku:</label>
                                <input class="span12" type="password" name="passwordConf" id="rePassword" >
                                @error("passwordConf") <p class="alert alert-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="control-group">
                            <div class="controls clearfix">
                                <button type="submit" id="btnRegister" class="btn btn-primary pull-right">Dodaj</button>
                            </div>
                        </div>
                        @if(session("msg"))
                            <div class="module span8">
                                <p class="{{session("class")}}">{{session("msg")}}</p>
                            </div>
                        @endif
                    </div>
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
