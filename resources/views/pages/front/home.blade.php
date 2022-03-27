@extends("layouts.front")
@section("title")
    Vacation Rental | Home
@endsection

@section("showcase")
    <div class="hero-wrap js-fullheight"
         style="background-image:url({{asset("assets/images/xbg_1.jpg.pagespeed.ic.yXbuegvbmi.jpg")}})"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                 data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <h2 class="subheading">Dobrodosli na Vacation Rental</h2>
                    <h1 class="mb-4">Pronadji svoje idealno mesto za uzivanje</h1>
                    <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact
                            us</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("content")
    @component("partials.searchSection",["locations" => $locations,"categories"=>$categories])
    @endcomponent

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Pogledajte Nase Kategorije</h2>
                    <span class="subheading">Top kategorije</span>
                </div>
            </div>
            <div class="row d-flex">

                @foreach($categories as $cat)
                    @if($loop->index < 6)
                        @component("partials.category",["category"=>$cat])
                        @endcomponent
                    @endif
                @endforeach
            </div>
        </div>
    </section>



    <section class="ftco-section bg-light">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Najnoviji oglasi</h2>
                </div>
            </div>
            <div class="row no-gutters">
                @foreach($venues as $venue)
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex">
                            <a href="#" class="img"
                               style="background-image:url({{asset("storage/venues/".$venue->path)}})"></a>
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 p-xl-5 text-center">
                                    <p class="star mb-0"><span class="fa fa-star"></span><span
                                            class="fa fa-star"></span><span class="fa fa-star"></span><span
                                            class="fa fa-star"></span><span class="fa fa-star"></span></p>

                                    <h3 class="mb-3"><a href="#">{{$venue->name}}</a></h3>
                                    <ul class="list-accomodation">
                                        <li><span>Gostiju:</span>{{$venue->max_guests}} </li>
                                        <li><span>Size:</span> {{$venue->square_footage}} m2</li>
                                        <li><span>Soba:</span> {{$venue->num_rooms}}</li>
                                        <li><span>Cena:</span> {{number_format($venue->price,0)}}&euro; nocenje</li>
                                    </ul>
                                    <p class="pt-1"><a
                                            href="{{route("vikendice.show",["vikendice" => $venue->id])}}"
                                            class="btn-custom px-3 py-2">Pogledajte vise<span
                                                class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="ftco-intro"
             style="background-image:url({{asset("assets/images/xservices-3.jpg.pagespeed.ic.UNMYVVohjO.jpg")}})"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <h2>Ready to get started</h2>
                    <p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line
                        with your questions.</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Book now</a> <a href="#"
                                                                                                  class="btn btn-white px-4 py-3">Contact
                            us</a></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-services mt-5">
        <div class="container">
            <div class="my-5 py-5 heading-section text-center ftco-animate">
                <h2 class="mt-5">Izdvajamo iz ponude</h2>
                <span class="subheading">Top Destinacije</span>
            </div>
            <div class="row">
                @foreach($locations as $location)
                    @if($loop->index < 6)
                        @component("partials.location",["location"=>$location])
                        @endcomponent
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section("scripts")
    @include("fixed.front.scripts")
@endsection


