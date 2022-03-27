<div class="col-md-4 d-flex ftco-animate">
    <div class="blog-entry align-self-stretch">
        <a href="{{route("vikendice.index",["category"=>$category->id])}}" class="block-20 rounded" style="background-image:url({{asset("assets/images/$category->photo_path")}})">
        </a>
        <div class="text p-4 text-center">
            <h3 class="heading"><a href="{{route("vikendice.index",["category"=>$category->id])}}">{{$category->name}}</a></h3>

            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
    </div>
</div>
