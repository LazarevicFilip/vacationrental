

@extends("layouts.backend")
@section("title")
    VactionRental - Prijava
    @endsection
@section("content")
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="post" action="{{route("doLogin")}}">
                        @csrf
                        <div class="module-head">
                            <h3>Prijava</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" name="email"  placeholder="Email">
                                    @error("email") <p class="mt-5 alert-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" name="password" placeholder="Lozinka">
                                    @error("password") <p class="mt-5 alert-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <input type="submit" value="Prijava" name="btnSubmit"  class="btn btn-primary pull-right" />
                                </div>
                            </div>
                        </div>
                    </form>
                    @if(session("err"))
                        <div class="alert alert-danger">
                            <strong>{{session("err")}}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->
@endsection

