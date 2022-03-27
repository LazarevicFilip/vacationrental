@extends("layouts.backend")

@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                @include("fixed.back.sidebar")
                <div class="module span8">
                    <div class="module-head">
                        <h3>Lokacije</h3>
                    </div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="datatable-1 table table-bordered table-striped	 display"
                               width="100%">
                            <thead>
                            <tr>
                                <th>
                                    Naziv
                                </th>
                                <th>
                                    Izbrisi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr class="gradeA">
                                    <td>
                                        {{$category->name}}
                                    </td>
                                    <td class="center">
                                        <form action="{{route("categories.destroy",["category"=>$category->id])}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" value="Izbrisi" class="form-control btn btn-info">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(session("msg"))
                    <div class="offset3 span7">
                        <p class="{{session("class")}}">{{session("msg")}}</p>
                    </div>
                @endif
                <a class="span2 offset9 btn btn-primary" href="{{route("categories.create")}}" >Dodaj kategoriju</a>
                {{--                --}}
            </div>
        </div>
    </div>

@endsection


@section("scripts")
    @parent

    <script src="{{asset("assets/js/admin/common.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/admin/jquery.dataTables.js")}}" type="text/javascript"></script>
@endsection
