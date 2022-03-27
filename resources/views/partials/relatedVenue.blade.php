<div class="col-md-6 col-lg-4 mb-4">
    <a href="{{route("vikendice.show",["vikendice"=>$venue->id])}}" class="prop-entry d-block">
        <figure>
            <img src="{{asset("storage/venues/".$venue->path)}}" alt="{{$venue->name}}" class="img-fluid">
        </figure>
        <div class="prop-text">
            <div class="inner">
                <span class="price rounded">{{$venue->price}}&euro;</span>
                <h3 class="title">{{$venue->name}}</h3>
                <p class="location">{{$venue->address}}</p>
            </div>
            <div class="prop-more-info">
                <div class="inner d-flex">
                    <div class="col">
                        <span>Povrsina:</span>
                        <strong>{{$venue->square_footage}}<sup>2</sup></strong>
                    </div>
                    <div class="col">
                        <span>Kreveti:</span>
                        <strong>{{$venue->num_beds}}</strong>
                    </div>
                    <div class="col">
                        <span>WC:</span>
                        <strong>{{$venue->num_wc}}</strong>
                    </div>
                    <div class="col">
                        <span>Gosti:</span>
                        <strong>{{$venue->max_guests}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
