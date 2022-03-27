@extends("layouts.front")

@section("showcase")
    <section class="hero-wrap hero-wrap-2" style="background-image:url({{asset("assets/images/showcase.jpeg")}})" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Vikendice</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("content")
    @include("partials.searchSection")

    <section class="ftco-section ftco-services mt-5">
        <div class="container">
            <div class="my-5 py-5 heading-section text-center ftco-animate">
                <h2>Izdvajamo iz ponude</h2>
                <span class="subheading">Top Destinacije</span>
            </div>
            <div class="row" id="venues">
                @forelse($venues as $venue)
                    @component("partials.venue",["venue"=>$venue])
                    @endcomponent
                @empty
                    <div class="col-md-12 h3 ftco-animate">
                        Trenutno nema rezultata za unete parametre..
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @if($pagesCount > 0)
    <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example mb-5">
                        <ul class="pagination justify-content-center">
                            @for($i=0;$i < $pagesCount;$i++)
                                <li class="page-item"><a class="page-link pagination-link" href="" data-id="{{$i}}">{{$i+1}}</a></li>
                            @endfor
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section("scripts")
    @include("fixed.front.scripts")
@endsection
