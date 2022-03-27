@extends("layouts.front")

@section("content")
@php
    foreach($venue->photos as $photo){
    if($photo->is_thumbnail == 1){
        $thumbnail = $photo->path;
    }
}
@endphp
    <div class="site-blocks-cover overlay" style="background-image: url({{asset("storage/venues/".$thumbnail)}});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Detalji Objekta Za</span>
                    <h1 class="mb-2">{{$venue->item->name}}</h1>
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{$venue->item->address}}</strong></p>
                </div>
            </div>
        </div>
    </div>}
    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="margin-top: -150px;">
                    <div class="mb-5">
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach($venue->photos as $photo)
                                @if($loop->index < 3)
                                    <div><img src="{{asset("storage/venues/".$photo->path)}}" alt="$photo->alt" class="img-fluid"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">{{number_format($venue->item->price,0)}}&euro; noc</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                    <li>
                                        <span class="property-specs">Sobe</span>
                                        <span class="property-specs-number">{{$venue->item->num_rooms}}</span>
                                    </li>
                                    <li>
                                        <span class="property-specs">Kreveti</span>
                                        <span class="property-specs-number">{{$venue->item->num_beds}}</span>
                                    </li>
                                    <li>
                                        <span class="property-specs">Kupatila</span>
                                        <span class="property-specs-number">{{$venue->item->num_beds}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Broj Gostiju</span>
                                <strong class="d-block">{{$venue->item->max_guests}}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Povrsina</span>
                                <strong class="d-block">{{$venue->item->square_footage}}m<sup>2</sup> </strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Kategorije:</span>
                                @foreach($venue->categories as $cat)
                                <strong class="d-block">{{$cat->category}}</strong>
                                @endforeach
                            </div>
                        </div>
                        <h2 class="h4 text-black">Opis objekta</h2>
                        <p>{{$venue->item->description}} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut dolore doloribus dolorum id nostrum odio odit soluta unde vitae? Autem corporis dicta facilis incidunt nesciunt reprehenderit sapiente similique tenetur! Aliquid aperiam dolores earum enim est ipsa, ipsam minima mollitia necessitatibus non officiis pariatur provident quaerat quod saepe sed unde.</p>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Dodatni sadrzaj</h2>
                            </div>
                            @foreach($venue->additionalContents as $item)
                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <p class="font-weight-bold"><i class="fa-solid fa-arrow-right text-success mr-2"></i>{{$item->name}}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Galerija</h2>
                            </div>
                            @foreach($venue->photos as $photo)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <a href="images/img_1.jpg" class="image-popup gal-item"><img src="{{asset("storage/venues/".$photo->path)}}" alt="Image" class="img-fluid"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pl-md-5">
                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3">Rezervisite</h3>
                        <form action="{{route("reserve")}}" method="post" class="form-contact-agent">
                            @csrf
                            <div class="form-group">
                                <label for="date">Izaberite datum rezervacije:</label>
                                <input type="date" name="date" class="form-control">
                                @error("date")<p class="alert alert-danger">{{$message}}@enderror
                                <input type="hidden" name="user_id" value="{{$venue->venueOwner->id}}" class="form-control">
                                @error("user_id") <p class="alert alert-danger">{{$message}} </p> @enderror
                                <input type="hidden" name="venue_id" value="{{$venue->item->id}}" class="form-control">
                                @error("venue_id")<p class="alert alert-danger">{{$message}}  @enderror
                            </div>
                            <div class="form-group mt-4">
                                <input type="submit" id="phone" class="btn btn-primary" value="Rezervisite">
                            </div>
                            @if(session("msg"))
                                <p class="{{session("class")}}">{{session("msg")}}</p>
                            @endif
                        </form>
                    </div>
                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3">Kontaktirajte vlasnika direktno.</h3>
                        <p><i class="mx-2 fa-solid fa-envelope"></i>{{$venue->venueOwner->email}}</p>
                        <p><i class="mx-2 fa-solid fa-phone"></i>{{$venue->venueOwner->phone}}</p>
                        <p><i class="mx-2 fa-solid fa-user"></i>{{$venue->venueOwner->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section site-section-sm bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Objekti u blizini</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                @forelse($venue->relatedObjects as $obj)
                        @if($obj->id != $venue->item->id)
                            @component("partials.relatedVenue",["venue"=>$obj])
                            @endcomponent
                        @endif
                    @empty
                        <p>Trenutno nema slicnih objekata...</p>
                    @endforelse
            </div>
        </div>


    </div>
@endsection
@section("scripts")

    <link rel="stylesheet" href="https://preview.colorlib.com/theme/homespace/fonts,_icomoon,_style.css+css,_bootstrap.min.css+css,_magnific-popup.css+css,_jquery-ui.css+css,_owl.carousel.min.css+css,_owl.theme.default.min.css+css,_bootstrap-datepicker.css+css,_mediaelementplayer.css+css,_animate.css+fonts,_flaticon,_font,_flaticon.css+css,_fl-bigmug-line.css+css,_aos.css+css,_style.css.pagespeed.cc.UqwR5Vrsnm.css" />


    <script src="{{asset("assets/js/venueDetails/jquery-3.3.1.min.js")}}"></script>
    <script src="{{asset("assets/js/venueDetails/jquery-migrate-3.0.1.min.js+jquery-ui.js+popper.min.js.pagespeed.jc.bDNmxUOFdS.js")}}"></script>
    <script>eval(mod_pagespeed_wJj8bA1s81);</script>
    <script>eval(mod_pagespeed_56AV8jULsp);</script>
    <script>eval(mod_pagespeed_tFqDnpwdbs);</script>
    <script src="{{asset("assets/js/venueDetails/bootstrap.min.js")}}"></script>
    <script src="{{asset("assets/js/venueDetails/owl.carousel.min.js")}}"></script>
    <script src="{{asset("assets/js/venueDetails/mediaelement-and-player.min.js")}}"></script>

    <script src="{{asset("assets/js/venueDetails/jquery.stellar.min.js+jquery.countdown.min.js+jquery.magnific-popup.min.js+bootstrap-datepicker.min.js+aos.js.pagespeed.jc.WL-BpjxsDO.js")}}"></script>
    <script>eval(mod_pagespeed_TiQnMai1Mt);</script>
    <script>eval(mod_pagespeed_4hg$fo885c);</script>
    <script>eval(mod_pagespeed_zlPPqCOvQC);</script>
    <script>eval(mod_pagespeed_TXrFTYPww9);</script>
    <script>eval(mod_pagespeed_9slKovpnya);</script>
    <script src="{{asset("assets/js/venueDetails/test.js")}}"></script>



@endsection








