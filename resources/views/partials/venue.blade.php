<div class="col-md-4 d-flex ftco-animate">
    <div class="blog-entry align-self-stretch">
        <a href="{{route("vikendice.show",["vikendice"=>$venue->id])}}" class="block-20 rounded" style="background-image:url({{asset("storage/venues/$venue->path")}})">
        </a>
        <div class="text p-4 text-center">
            <h3 class="heading"><a href="{{route("vikendice.show",["vikendice"=>$venue->id])}}">{{$venue->name}}</a></h3>
            <div class="meta mb-2">
                <div>Povrsina: {{$venue->square_footage}}m<sup>2</sup></div>
                <div>Broj soba: <i class="fa-solid fa-bed"></i> {{$venue->num_rooms}}</div>
                <div>Broj kupatila: <i class="fa-solid fa-shower"></i> {{$venue->num_wc}}</div>
                <div>Broj gostiju: <i class="fa-solid fa-person"></i> {{$venue->max_guests}}</div>
            </div>
            <a href=""> <p class="text-info font-weight-bold">Cena po nocenju: {{$venue->price}} &euro;</p></a>
        </div>
    </div>
</div>
