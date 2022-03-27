@extends("layouts.backend")

@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                @include("fixed.back.sidebar")
                <div class="module span8">
                    <div class="module-head">
                        <h3>Korisnici</h3>
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
                                    Korisnik
                                </th>
                                <th>
                                    Kreiran
                                </th>
                                <th>
                                    Obrisi
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($venues as $venue)
                                <tr class="gradeA">
                                    <td>
                                        {{$venue->name}}
                                    </td>
                                    <td>
                                        {{$venue->user->name}}
                                    </td>
                                    <td>
                                        {{$venue->created_at}}
                                    </td>
                                    <td class="center">
                                        <form action="{{route("venues.destroy",["vikendice"=>$venue->id])}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="hidden" name="id" value="{{$venue->id}}">
                                                <input type="submit" value="Obrisi" class="form-control btn btn-info">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                @if(session("msg"))
                    <div class="module span8">
                        <p class="{{session("class")}}">{{session("msg")}}</p>
                    </div>
                @endif
                <a class="span2 offset9  btn btn-primary" href="{{route("venues.create")}}" >Dodaj oglas</a>
            </div>
        </div>
    </div>

@endsection


@section("scripts")
    @parent

    <script src="{{asset("assets/js/admin/common.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/admin/jquery.dataTables.js")}}" type="text/javascript"></script>
@endsection
