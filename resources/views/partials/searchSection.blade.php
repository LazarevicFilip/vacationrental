<div class="py-5 mb-5">
    <div class="container">
        <form action="{{route("vikendice.index")}}" method="get" class="row mb-5">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="category" id="category" class="form-control d-block rounded-0">
                        <option value="">Kategorije</option>
                        @foreach($categories as $cat)
                            @if(isset($queryString["category"]) && ($queryString["category"]==$cat->id))
                                <x-option-tag selected="selected" :val="$cat->id" :name="$cat->name"/>
                            @else
                                <x-option-tag :val="$cat->id" :name="$cat->name"/>
                            @endif
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="location" id="location" class="form-control d-block rounded-0">
                        <option value="">Lokacije</option>
                        @foreach($locations as $location)
                            @if(isset($queryString["location"]) && ($queryString["location"]==$location->id))
                                <x-option-tag selected="selected" :val="$location->id" :name="$location->name"/>
                            @else
                                <x-option-tag :val="$location->id" :name="$location->name"/>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>
            @php
                $arr = [1,2,3,4,5];
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="rooms" id="rooms" class="form-control d-block rounded-0">
                        <option value="">Broj soba</option>
                        @foreach($arr as $i)
                            @if(isset($queryString["rooms"]) && ($queryString["rooms"]==$i."+"))
                                    <option selected value="{{$i."+"}}">{{$i."+"}}</option>
                            @elseif(isset($queryString["rooms"]) && ($queryString["rooms"]==$i))
                                    <option selected value="{{$i}}">{{$i}}</option>
                            @elseif($loop->last)
                                <option value="{{$i."+"}}">{{$i."+"}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="bathrooms" id="bathrooms" class="form-control d-block rounded-0">
                        <option value="">Broj kupatila</option>
                        @foreach($arr as $i)
                            @if(isset($queryString["bathrooms"]) && ($queryString["bathrooms"]==$i."+"))
                                <option selected value="{{$i."+"}}">{{$i."+"}}</option>
                            @elseif(isset($queryString["bathrooms"]) && ($queryString["bathrooms"]==$i))
                                <option selected value="{{$i}}">{{$i}}</option>
                            @elseif($loop->last)
                                <option value="{{$i."+"}}">{{$i."+"}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $guestsArr = [
                    ["val" => "0-2", "name" => "do 2"],
                    ["val" => "2-4", "name" => "2-4"],
                    ["val" => "4-7", "name" => "4-7"],
                    ["val" => "7-10", "name" => "7-10"],
                    ["val" => "10+", "name" => "10+"],
                ]
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="guests" id="guests" class="form-control d-block rounded-0">
                        <option value="">Broj gostiju</option>
                        @foreach($guestsArr as $item)
                            @if(isset($queryString["guests"]) && $queryString["guests"] == $item["val"])
                                <option selected value="{{$item["val"]}}">{{$item["name"]}}</option>
                            @else
                                <option value="{{$item["val"]}}">{{$item["name"]}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $priceArr = [
                    ["val" => "20", "name" => "do 20"],
                    ["val" => "40", "name" => "do 40"],
                    ["val" => "70", "name" => "do 70"],
                    ["val" => "100", "name" => "do 100"],
                    ["val" => "150", "name" => "do 150"],
                    ["val" => "200", "name" => "do 200"],
                    ["val" => "200+", "name" => "200+"],
                ]
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="price" id="price" class="form-control d-block rounded-0">
                        <option value="">Cena</option>
                        @foreach($priceArr as $price)
                            @if(isset($queryString["price"]) && $queryString["price"] == $price["val"])
                                <option selected value="{{$price["val"]}}">{{$price["name"]}} &euro;</option>
                            @else
                                <option value="{{$price["val"]}}">{{$price["name"]}} &euro;</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $perPage = [3,6,12,18,24];
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="select-wrap">
                    <span class="icon icon-arrow_drop_down"></span>
                    <select name="perPage" id="perPage" class="form-control d-block rounded-0">
                        <option value="">Prikaz po strani:</option>
                        @foreach($perPage as $page)
                            @if(isset($queryString["perPage"]) && $queryString["perPage"] == $page)
                                <option selected value="{{$page}}">{{$page}}</option>
                            @else
                                <option value="{{$page}}">{{$page}} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <input type="text" name="keyword" id="" class="form-control" value="{{$queryString["keyword"] ?? ""}}"  placeholder="Pretrazi oglase...">
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4 ml-auto">
                <input type="submit" class="btn btn-primary btn-block form-control-same-height rounded-0"
                       value="Search">
            </div>
        </form>

    </div>
</div>
