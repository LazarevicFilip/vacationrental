<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
    <div class="d-block services-wrap text-center">
        <div class="img" style="background-image:url({{asset("assets/images/$location->photo_path")}})"></div>
        <div class="media-body py-4 px-3">
            <h3 class="heading">{{$location->name}}</h3>
            <p><a href="{{route("vikendice.index",["location"=>$location->id])}}" class="btn btn-primary">Pronadji vise</a></p>
        </div>
    </div>
</div>
