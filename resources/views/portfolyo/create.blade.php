@include('layouts.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="background-img">
    <img src="/img/bg-2.jpg">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Yeni Müşteri</div>

                <div class="card-body">
                    <form id=musteriKaydet action="/portfolyo/musteriKaydet" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="isim">Müşteri Adı</label>
                            <input type="text" autofocus name="isim" class="form-control" id="isim" autocomplete="off"
                                placeholder="Müşteri Adını Giriniz." value="{{ old('isim') }}" onkeyup="kisiArama()" />
                            @error('isim')
                            <small style="color:red !important" id="gorevSmall" class="form-text text-muted"> Lütfen
                                isim giriniz.</small>
                            @enderror
                        </div>

                        <script type="text/javascript">
                            function kisiArama() {
                                var sonuc;
                                $.ajax({
                                    type: 'get',
                                    url: '/kisiaramainput',
                                    data: {
                                        'aramaText': document.getElementById('isim').value
                                    },
                                    success: function (response) {
                                        sonuc = response;
                                        console.log(response);
                                        $("#isim").autocomplete({
                                            source: sonuc
                                        });
                                    }
                                })
                            }

                        </script>
                        <div class="form-group">
                            <label for="sehir">Şehir</label>
                            <select name="sehir" id="sehir" class="form-control">
                                @foreach ($sehirler as $sehir)
                                <option name="sehirselect" id="sehirselect" value="{{ $sehir}}">
                                    {{ $sehir }}
                                </option>
                                @endforeach
                            </select>
                            {{-- <input type="text" name="sehir" class="form-control" id="sehir" autocomplete="off"
                                placeholder="Şehir Giriniz." value="{{ old('sehir') }}" /> --}}
                            @error('sehir')
                            <small style="color:red !important" id="gorevSmall" class="form-text text-muted">
                                Lütfen
                                şehir giriniz.</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sektor">Sektör</label>
                            <input type="text" name="sektor" class="form-control" id="sektor" autocomplete="off"
                                placeholder="Sektör Giriniz." value="{{ old('sektor') }}" />
                            @error('sektor')
                            <small style="color:red !important" id="gorevSmall" class="form-text text-muted">
                                Lütfen
                                sektör giriniz.</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newtelefon">Telefon</label>
                            <input type="number" name="newtelefon" class="form-control" id="newtelefon"
                                autocomplete="off" placeholder="Telefon Giriniz." value="{{ old('newtelefon') }}" />
                            @error('newtelefon')
                            <small style="color:red !important" id="gorevSmall" class="form-text text-muted">
                                Lütfen
                                telefon giriniz.</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="atanan_id">Atanan Kişi</label>
                            <select class="form-control" name="atanan_id" id="exampleFormControlSelect1"
                                value="{{ old('atanan_id') }}">
                                @foreach ($users as $user)

                                <option value={{ $user->id }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Durum">Durum</label>
                            <select name="durum" class="form-control" id="durum">
                                @foreach ($durumlar as $durum)
                                <option {{old('durum',$musteri->durum ?? '')=="$durum->id"? 'selected' :''}}
                                    value="{{ $durum->id }}">
                                    {{ $durum->durum_aciklama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <input type="checkbox" name="kosgebbelgesi" style="height:20px;width:50px"
                                    id="kosgebbelgesi" value="1" />
                                <span>
                                    Kosgeb Belgesi var mı? &nbsp;
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vergi_no">Vergi No</label>
                            <input type="number" name="vergi_no" class="form-control" id="vergi_no" autocomplete="off"
                                placeholder="Vergi No Giriniz." value="{{ old('vergi_no') }}" />
                        </div>
                        <div class="form-group">
                            <label for="notlar">Notlar</label>
                            <textarea type="text" name="notlar" class="form-control" id="notlar" autocomplete="off"
                                placeholder="Notlar." value="{{ old('notlar') }}"></textarea>

                        </div>
                        <script>
                            jQuery(document).ready(function ($) {
                                $('#musteriKaydet').on('submit', function (e) {
                                    if (!confirm('Kayıt yapmak istediğinize emin misiniz?')) {
                                        e.preventDefault();
                                    }
                                });
                            });

                        </script>
                        <button class="btn btn-primary">Ekle</button>
                        @error('kisimevcut')
                        <h4 style="color:red !important" id="gorevSmall" class="form-text text-muted">
                            Kişi Zaten Kayıtlı !</h4>
                        @enderror
                    </form>
                </div>

                <script>


                </script>
            </div>
        </div>
    </div>
</div>
