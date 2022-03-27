@extends("layouts.front")
@section("title")
    Vacation Rental - Profile
@endsection

@section("content")
    @include("fixed.front.tabs")
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="my-5" id="result">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <table class="table" id="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Datum objavljivanja</th>
                        <th scope="col">Izmeni</th>
                        <th scope="col">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @php
                        $rb = 1;
                    @endphp
                        @forelse($venues as $venue)
                            <tr>
                                <th scope="row">{{$rb++}}</th>
                                <td>{{$venue->name}}</td>
                                <td>{{$venue->created_at}}</td>
                                <td data-id="{{$venue->id}}"><a href="{{route("vikendice.edit",["vikendice"=>$venue->id])}}" class="btn btn-info">Izmeni</a></td>
                                <td data-id="{{$venue->id}}"><div class="btn btn-danger delete-item">Obrisi</div></td>
                            </tr>
                        @empty
                            <p class="lead">Trenutno nemate nijedan oglas.</p>
                            <script>
                                table.innerHTML = "";
                            </script>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mx-auto" id="paginationLinks">
                {{ $venues->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>



@endsection

@section("scripts")
    @include("fixed.front.scripts")
@endsection


