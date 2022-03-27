@extends("layouts.backend")

@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                @include("fixed.back.sidebar")
                <div class="span9">
                    <div class="content">
                        <div class="btn-controls">
                            <div class="btn-box-row row-fluid">
                                <a href="#" class="btn-box big span4"><i
                                        class="fa-solid fa-users"></i><b>{{$users->count()}}</b>
                                    <p class="text-muted">
                                        Korisnici</p>
                                </a>
                                <a href="#" class="btn-box big span4"><i class="fa-solid fa-house"></i>
                                    <b>{{$venues->count()}}</b>
                                    <p class="text-muted">
                                        Oglasi</p>
                                </a>
                                <a href="#" class="btn-box big span4"><i class="fa-solid fa-chart-line"></i><b>{{number_format($prices->average("price"),2)}}&euro;</b>
                                    <p class="text-muted">
                                        Prosecna cena oglasa po nocenju.</p>
                                </a>
                            </div>
                            <div class="btn-box-row row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <a href="#" class="btn-box small span4"><i class="fa-solid fa-user"></i><b>{{$users->where("role_id",3)->count()}}</b><p class="text-muted">Prodavci</p>
                                            </a>
                                            <a href="#" class="btn-box small span4"><i class="fa-solid fa-user"></i><b>{{$users->where("role_id",2)->count()}}</b><p class="text-muted">Kupci</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <a href="#" class="btn-box small span4"><i class="fa-solid fa-location-pin"></i><b>{{$locations->count()}}</b><p class="text-muted">Lokacije</p>
                                            </a>
                                            <a href="#" class="btn-box small span4"><i class="fa-solid fa-box"></i><b>{{$categories->count()}}</b><p class="text-muted">Kategorije</p>
                                            </a>
                                            <a href="#" class="btn-box small span4"><i class="fa-solid fa-bullseye"></i><b>{{$additional->count()}}</b><p class="text-muted">Dodatni sadrzaj</p>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>

                        <!--/.module-->
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
@endsection

@section("scripts")
    @parent

    <script src="{{asset("assets/js/admin/common.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/admin/jquery.dataTables.js")}}" type="text/javascript"></script>
@endsection




