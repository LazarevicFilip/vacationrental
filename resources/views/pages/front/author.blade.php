@extends("layouts.front")

@section("content")
    <div class="container">
        <div class="row my-5 d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <img src="{{asset("assets/images/ja.JPG")}}" width="400px" class="img-fluid p-3 rounded" alt="Filip Lazarevic">
            </div>
            @php
            $dob = date("Y") - 2000;
            @endphp
            <div class="col-md-6">
                My name is Filip Lazarević. I come from Pancevo. I am {{$dob}} years old and I am a student of ICT collage in Belgrade that recently became academy. I started doing programming a little over a year ago and I really liked it. I would like to do it in the future.I spend my free time mostly with family and friends.That's it from me.
            </div>
        </div>
    </div>

@endsection
