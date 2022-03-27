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
                                    Ime i prezime
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                   Telefon
                                </th>
                                <th>
                                    Uloga
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                           <tbody>
                                @foreach($users as $user)
                                    <tr class="gradeA">
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->phone}}
                                        </td>
                                        <td class="center">
                                            {{$user->role->name}}
                                        </td>
                                        <td class="center">
                                            <form action="{{route("ban")}}" method="POST">
                                                @csrf
                                                @method("PATCH")
                                                <input type="hidden" name="user" value="{{$user->id}}">
                                                @if($user->is_banned)
                                                    <input type="submit" value="Unban" class="form-control btn btn-primary">
                                                @elseif(!$user->is_banned)
                                                    <input type="submit" value="Ban" class="form-control btn btn-info">
                                                @endif
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
                <a class="span2 offset9  btn btn-primary" href="{{route("users.create")}}" >Dodaj korisnika</a>
            </div>
        </div>
    </div>

@endsection


@section("scripts")
    @parent

    <script src="{{asset("assets/js/admin/common.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/admin/jquery.dataTables.js")}}" type="text/javascript"></script>
@endsection
