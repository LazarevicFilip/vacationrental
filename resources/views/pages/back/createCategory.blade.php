@extends("layouts.backend")
@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                @include("fixed.back.sidebar")
                <div class="span8">
                    <form action="{{route("categories.store")}}" method="post" class="form-vertical span8" enctype="multipart/form-data" >
                        @csrf
                        <div class="module-head">
                            <h3>Nova kategorija</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="name">Kategorija:</label>
                                    <input class="span12" type="text" name="name" id="name" value="{{old("name") ?? ""}}">
                                    @error("name")  <p class="alert alert-danger">{{$message}}</p>  @enderror
                                </div>
                                <div class="controls row-fluid">
                                    <label for="name">Slika:</label>
                                    <input class="span12" type="file" name="photo_path" id="name" value="{{old("photo_path") ?? ""}}">
                                    @error("photo_path")  <p class="alert alert-danger">{{$message}}</p>  @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right">Dodaj</button>
                                </div>
                            </div>
                            @if(session("msg"))
                                <div class="span8">
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

