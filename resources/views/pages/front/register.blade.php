



@extends("layouts.backend")
@section("title")
    VactionRental - Registracija
@endsection

@section("content")

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical">
                        <div class="module-head">
                            <h3>Registracija</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="name">Ime i przime:</label>
                                    <input class="span12" type="text" id="name" placeholder="Marko Markovic">
                                    <small class="form-text text-danger hide">Ime i prezime moraja poceti velikim slovom.</small>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="email">Email:</label>
                                    <input class="span12" type="text" id="email" placeholder="marko@gmail.com">
                                    <small class="form-text text-danger hide">Morate uneti ispravan format email adrese.</small>
                                </div>
                            </div>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="phone">Telefon:</label>
                                    <input class="span12" type="text" id="phone" placeholder="06XXXXXXX">
                                    <small class="form-text text-danger hide">Broj telefona bez pozivnog broja i razmaka izmedju cifara.</small>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="ddl">Kupac/Prodavac</label>
                                    <select class="span12"  id="ddl">
                                        <option value="0">Izaberite</option>
                                        <option value="2">Kupac - moze da rezervise objekte.</option>
                                        <option value="3">Prodavac - moze da rezervise i postavlja svoje objekte.</option>
                                    </select>
                                    <small class="form-text text-danger hide">Ne sme ostati opcija "Izaberite"</small>
                                </div>
                            </div>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="password">Lozinka:</label>
                                    <input class="span12" type="password" id="password" >
                                    <small class="form-text text-danger hide">Lozinka mora sadrzati barem 8 karaktera,po jedno veliko i malo slovo i jedanu cifru.</small>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <label for="rePassword">Potvrdi Lozinku:</label>
                                    <input class="span12" type="password" id="rePassword" >
                                    <small class="form-text text-danger hide">Lozinke se ne poklapaju.</small>
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" id="btnRegister" class="btn btn-primary pull-right">Prijava</button>
                                </div>
                            </div>
                            <div id="errors"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->
@endsection


