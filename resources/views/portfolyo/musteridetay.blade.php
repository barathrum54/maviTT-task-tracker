@include('layouts.app')
<script>
    function Borclandir() {
        var tutar = document.getElementById('borclandirInput').value;
        var duzeltme = document.getElementById('borclandirduzeltme').value;
        if ($('#borclandirduzeltme').is(':checked')) {
            duzeltme = true;
        } else {
            duzeltme = false;
        }
        var musteri_id = document.getElementById('musteri_id').value;
        $.ajax({
            url: "{{ url('muhasebe/islemYap') }}",
            type: 'post',
            data: {
                tutar: tutar,
                duzeltme: duzeltme,
                musteri_id: musteri_id,
                BA: 'B',
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                location.reload();
                console.log('Success', tutar, musteri_id, 'B');
            },
            error: function (result) {
                alert(JSON.stringify(result));
            }
        });
    }

    function Export() {
        isim = document.getElementById('isim').value;
        telefon = document.getElementById('newtelefon').value;
        if (telefon.charAt(0) != 0) {
            telefon = 0 + telefon;
        }
        sektor = document.getElementById('sektor').value;
        sehir = document.getElementById('sehir').value;
        url = window.location.href;

        document.getElementById('copyArea').value = isim + '\n' + telefon + '\n' + sektor + '\n' + sehir + '\n' + url;
        document.getElementById('copyArea').select();
        document.execCommand('copy');

        toastr.success('Müşteri Detayı Kopyalandı')
    }

    function Tahsilat() {
        var tutar = document.getElementById('tahsilatInput').value;
        var musteri_id = document.getElementById('musteri_id').value;
        var duzeltme = document.getElementById('duzeltme').value;
        if ($('#duzeltme').is(':checked')) {
            duzeltme = true;
        } else {
            duzeltme = false;
        }
        $.ajax({
            url: "{{ url('muhasebe/islemYap') }}",
            type: 'post',
            data: {
                tutar: tutar,
                musteri_id: musteri_id,
                BA: 'A',
                duzeltme: duzeltme,
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                location.reload();
                console.log('Success', tutar, musteri_id, 'A');
            },
            error: function (result) {
                alert(JSON.stringify(result));
            }
        });
    }



    function dosyaIndir(dosyaKodu) {
        var musteri_id = document.getElementById('musteri_id').value;

        $.ajax({
            url: "/dosyaIndir",
            type: 'post',
            data: {
                dosyaKodu: dosyaKodu,
                musteri_id: musteri_id,
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                alert('success');
                console.log('Success');
            },
            error: function (result) {
                alert(JSON.stringify(result));
            }
        });
    }

    function dosyaSil(dosyaKodu) {
        var musteri_id = document.getElementById('musteri_id').value;

        $.ajax({
            url: "/dosyaSil",
            type: 'post',
            data: {
                dosyaKodu: dosyaKodu,
                musteri_id: musteri_id,
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                alert('success');
                console.log('Success');
                refresh();
            },
            error: function (result) {
                alert(JSON.stringify(result));
            }
        });
    }

    function refresh() {
        alert('refresh');
        location.reload();
        $('#dosyalar').modal('show');
    }

    function bilgiPopup(id) {
        var ba;
        var tutar;
        var tarih;
        var duzeltme;

        $.ajax({
            url: "{{ url('muhasebe/getHareket') }}",
            type: 'post',
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                ba = result.BA;
                var formattedDate = new Date(result.created_at);
                var d = formattedDate.getDate();
                var m = formattedDate.getMonth();
                m += 1; // JavaScript months are 0-11
                var y = formattedDate.getFullYear();

                tarih = d + "/" + m + "/" + y;
                tutar = result.tutar;
                if (result.duzeltme == true) {
                    duzeltme = 'Evet';
                } else {
                    duzeltme = 'Hayır';
                }
                if (result.BA == 'A') {
                    ba = '<span style="color:Green">Alacak</span>';
                } else {
                    ba = '<span style="color:Red">Borç</span>';
                }
                document.getElementById('baTD').innerHTML = ba;
                document.getElementById('tutarTD').innerHTML = tutar;
                document.getElementById('tarihTD').innerHTML = tarih;
                document.getElementById('duzeltmeTD').innerHTML = duzeltme;
                document.getElementById('hareketIdHidden').value = id;
                $('#tahsilatInfo').modal('show');
            },
            error: function (result) {
                alert(JSON.stringify(result));
            }
        });

    }

    function hareketSil(id) {
        if (confirm('Silmek istediğinizden emin misiniz?')) {
            $.ajax({
                url: "{{ url('muhasebe/deleteHareket') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    alert(result.id + ' numaralı hareket silindi.')
                    location.reload();
                },
                error: function (result) {
                    alert(JSON.stringify(result));
                }
            });
        }

    }

    function bakiyeKapat(id) {
        if (confirm('"Bakiye Kapatmak" istediğinizden emin misiniz?')) {
            $.ajax({
                url: "{{ url('muhasebe/bakiyeKapat') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    alert(result.id + ' numaralı müşterinin Bakiyesi Kapandı.')
                    location.reload();
                },
                error: function (result) {
                    alert(JSON.stringify(result));
                }
            });
        }

    }

    function bakiyeAc(id) {
        if (confirm('"Bakiye Açmak" istediğinizden emin misiniz?')) {
            $.ajax({
                url: "{{ url('muhasebe/bakiyeAc') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    alert(result.id + ' numaralı müşterinin Bakiyesi Tekrar Açıldı.')
                    location.reload();
                },
                error: function (result) {
                    alert(JSON.stringify(result));
                }
            });
        }

    }

</script>

<div class="background-img">
    <img src="/img/bg-2.jpg">
</div>
<div class="container mt-5  animated fadeIn ">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <h2 class="pl-3 text-muted">
                                Müşteri Detay
                            </h2>

                        </div>

                        <div class="col">


                            <script>
                                jQuery(document).ready(function ($) {
                                    $('#musteriSil').on('submit', function (e) {
                                        if (!confirm('Silmek istediğinizden emin misiniz?')) {
                                            e.preventDefault();
                                        }
                                    });
                                });

                            </script>
                            <script>
                                var sifreler = false;
                                var sifreBool = false;

                                function sifreDogru() {
                                    var sifre = document.getElementById('guvenlikSifresiInput').value;
                                    var gsi = 'ş'
                                    $.ajax({
                                        url: '/portfolyo/gsi',
                                        type: 'get',
                                        success: function (result) {
                                            gsi = result;
                                            if (sifre == gsi) {
                                                sifreBool = true;
                                                document.getElementById('edevlet_sifresi').type = 'text';
                                                document.getElementById('tc').type = 'text';
                                                document.getElementById('email_sifresi').type = 'text';
                                                $('#sifreInputModal').modal('toggle')
                                            }
                                        },
                                        error: function (result) {
                                            alert(JSON.stringify(result));
                                        }
                                    });

                                }

                                function toggleSifreler() {

                                    sifreler = !sifreler;
                                    if (sifreler == true) {
                                        $('#sifreInputModal').modal().show()
                                        document.getElementById('guvenlikSifresiInput').value = '';
                                        $("#sifreInputModal").on('shown.bs.modal', function () {
                                            $(this).find("input:visible:first").focus();
                                        });
                                    }
                                    if (sifreler == false) {
                                        document.getElementById('edevlet_sifresi').type = 'password';
                                        document.getElementById('tc').type = 'password';
                                        document.getElementById('email_sifresi').type = 'password';

                                    }
                                }

                            </script>
                            <button onclick="toggleSifreler()" class="btn btn-secondary float-right ml-2">
                                <i class="fa fa-lock" aria-hidden="true">
                                    <span style="font-size:9pt">
                                        Şifreleri Göster
                                    </span>
                                </i>
                            </button>

                            <button class="btn btn-success float-right ml-2" onclick="Export()">Paylaş</button>
                            <form action="/portfolyo/{{$musteri->id}}" id="musteriSil" method="post">
                                @method(' delete') @csrf @if ($admin_mi==1 && $rt_mi == 1)
                                <button class="btn btn-danger float-right">Sil</button> @endif
                            </form>


                        </div>


                    </div>
                </div>
                <div class="card-body">

                    <div class="row d-flex justify-content-center bg-primary py-1 text-light">
                        @foreach ($users as $user)
                        @if ($user->id == $musteri->kayit_yapan_id)
                        &nbsp;
                        <h6 class="card-subtitle mr-2 mt-1">
                            <span>
                                Kayıt Yapan:
                            </span>
                            {{ $user->name}}</h6>
                        @endif
                        @endforeach
                        <h6 class="card-subtitle mt-1">Son Güncelleme:
                            {{ date_format($musteri->updated_at,"d/m/Y H:i") }}</h6>
                        @foreach ($users as $user)
                        @if ($user->id == $musteri->guncelleme_yapan_id)
                        &nbsp;
                        <h6 class="card-subtitle mt-1">
                            - {{ $user->name}}</h6>
                        @endif
                        @endforeach

                    </div>

                    <hr>
                    <form id=musteriGuncelle action="/portfolyo/musteriGuncelle/{{ $musteri->id }}"
                        enctype=" multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-3 ">
                                <label for="isiminput" class="small">Ad Soyad</label>
                                <input type="text" class="form-control" id="isim" name="isim"
                                    placeholder="{{ $musteri->isim }}" value="{{ $musteri->isim  }}">
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">Şehir</label>
                                <select name="sehir" id="sehir" class="form-control">
                                    @foreach ($sehirler as $sehir)
                                    <option name="sehirselect" id="sehirselect" value="{{ $sehir}}"
                                        {{old('durum',$musteri->sehir ?? '') == $sehir ? 'selected' : ''}}>
                                        {{ $sehir }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">Sektör</label>
                                <input type="text" class="form-control" id="sektor" class="form-control" name="sektor"
                                    placeholder="{{ $musteri->sektor }}" value="{{ $musteri->sektor}}">
                            </div>

                            <div class="col-md-3">
                                <label for="isiminput" class="small">Telefon</label>
                                <script>
                                    $(document).ready(function () {
                                        $('[data-toggle="tooltip"]').tooltip();
                                    });

                                </script>

                                <input type="text" data-toggle="tooltip" title="Telefon No Başına Sıfır Koymayınız"
                                    class="form-control" id="newtelefon" name="newtelefon"
                                    placeholder="{{ $musteri->newtelefon }}" value="{{ $musteri->newtelefon  }}">
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">Telefon 2</label>
                                <input type="text" class="form-control" id="tel2" name="tel2"
                                    placeholder="{{ $musteri->tel2 }}" value="{{ $musteri->tel2  }}">
                            </div>
                            <div class="col-md-3 ">
                                <label for="isiminput" class="small">TC Kimlik No</label>
                                <input type="password" id="tc" class="form-control" name="tc"
                                    placeholder="{{ $musteri->tc }}" value="{{ $musteri->tc  }}">
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">E-Devlet Şifresi</label>
                                <input type="password" class="form-control" id="edevlet_sifresi" name="edevlet_sifresi"
                                    placeholder="{{ $musteri->edevlet_sifresi }}"
                                    value="{{ $musteri->edevlet_sifresi}}">
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">E-Mail</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ $musteri->email }}" value="{{ $musteri->email  }}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="isiminput" class="small">E-Mail Şifresi</label>
                                <input type="password" class="form-control" id="email_sifresi" name="email_sifresi"
                                    placeholder="{{ $musteri->email_sifresi}}" value="{{ $musteri->email_sifresi  }}">
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small" style="color: blue">Durum</label>
                                <select name="durum" class="form-control" id="durum">
                                    @foreach ($durumlar as $durum)
                                    <option {{old('durum',$musteri->durum ?? '') == $durum->id ? 'selected' : ''}}
                                        value="{{ $durum->id }}">
                                        {{ $durum->durum_aciklama }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-3 d-flex pt-4 mt-2">

                                <input type="checkbox" name="kosgebbelgesi" style="height:20px;width:50px"
                                    id="kosgebbelgesi" value="1" {{ $musteri->kosgebbelgesi == 1 ? 'checked' : '' }} />
                                <label for="isiminput" style="color: indigo"><strong>Kosgeb
                                        Belgesi</strong></label>
                            </div>
                            <div class="col-md-3">
                                <label for="vergi_no"><small> Vergi No</small></label>
                                <input type="number" name="vergi_no" class="form-control" id="vergi_no"
                                    autocomplete="off" placeholder="{{ $musteri->vergi_no }}"
                                    value="{{ $musteri->vergi_no }}" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="isiminput" class="small"
                                    style="color: green"><strong>Atanan</strong></label>
                                <select class="form-control" name="atananselect" id="atananselect">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ ($user->id == $atanan->id ? "selected":"") }}>
                                        {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="onemSirasi"
                                    style="color: red;background-color:(255, 255, 255, 0.137)"><strong>Önem
                                        Sırası</strong></label>
                                <select class="form-control" name="onemSirasi" id="onemSirasi">
                                    <option value="0"
                                        {{ ($musteri->onemSirasi == null || $musteri->onemSirasi == 0 ? "selected":"") }}>
                                        Belirtilmemiş</option>
                                    <option value="1" {{ ($musteri->onemSirasi == 1 ? "selected":"") }}
                                        style="background-color:green;color:white">
                                        Yeşil</option>
                                    <option value="2" {{ ($musteri->onemSirasi == 2 ? "selected":"") }}
                                        style="background-color:rgb(255, 255, 0);color:green">
                                        Sarı
                                    </option>
                                    <option value="3" {{ ($musteri->onemSirasi == 3 ? "selected":"") }}
                                        style="background-color:red;color:white">
                                        Kırmızı</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="vergiLevhasiTarihi"
                                    style="color: blue;background-color:(255, 255, 255, 0.137)"><strong>Vergi Levhası
                                        Tarihi</strong></label>
                                @if (is_null($musteri->vergiLevhasiTarihi))
                                <input type="date" name="vergiLevhasiTarihi" id="vergiLevhasiTarihi" value="">
                                @else
                                <input type="date" name="vergiLevhasiTarihi" id="vergiLevhasiTarihi"
                                    value="{{ date('Y-m-d', strtotime($musteri->vergiLevhasiTarihi)) }}">
                                @endif


                            </div>
                            <div class="col-md-3">
                                <label for="taahhutnameTarihi"
                                    style="color: rgb(24, 206, 48);background-color:(255, 255, 255, 0.137)"><strong>Taahhütname
                                        Tarihi</strong></label>
                                @if (is_null($musteri->taahhutnameTarihi))
                                <input type="date" name="taahhutnameTarihi" id="taahhutnameTarihi" value="">
                                @else
                                <input type="date" name="taahhutnameTarihi" id="taahhutnameTarihi"
                                    value="{{ date('Y-m-d', strtotime($musteri->taahhutnameTarihi)) }}">
                                @endif


                            </div>
                            <div class="col-md-3">
                                <label for="kosgebBelgesiTarihi"
                                    style="color: blue;background-color:(255, 255, 255, 0.137)"><strong>KOSGEB Belgesi
                                        Tarihi</strong></label>
                                @if (is_null($musteri->kosgebBelgesiTarihi))
                                <input type="date" name="kosgebBelgesiTarihi" id="kosgebBelgesiTarihi" value="">
                                @else
                                <input type="date" name="kosgebBelgesiTarihi" id="kosgebBelgesiTarihi"
                                    value="{{ date('Y-m-d', strtotime($musteri->kosgebBelgesiTarihi)) }}">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="isiminput" class="small">NACE Kodu</label>
                                <input type="text" class="form-control" id="naceKodu" class="form-control"
                                    name="naceKodu" placeholder="{{ $musteri->naceKodu }}"
                                    value="{{ $musteri->naceKodu}}">
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <label for="notlar" class="mb-1" style="color: blue;margin-bottom:-3px">
                                Notlar
                            </label>
                            <textarea name="notlar" class=" shadow" id="notlar">{{ $musteri->notlar }} </textarea>
                        </div>
                        <script>
                            jQuery(document).ready(function ($) {
                                $('#musteriGuncelle').on('submit', function (e) {
                                    var musteriId = document.getElementById('musteri_id').value;
                                    var oldDurumID = document.getElementById('oldDurumId').value;
                                    var durumID = document.getElementById('durum').value;
                                    if (oldDurumID != 13 && oldDurumID != 11 && oldDurumID != 12 &&
                                        oldDurumID != 15 && oldDurumID != 19 && oldDurumID != 17 &&
                                        oldDurumID != 21) {
                                        if (durumID == 13 || durumID == 11 || durumID == 12) {
                                            if (confirm("Proje Tamamlamayı Onaylıyor Musunuz?")) {
                                                var targetUrl = '/portfolyo/tamamla';
                                                $.ajax({
                                                    url: targetUrl,
                                                    type: 'get',
                                                    data: {
                                                        musteriID: musteriId
                                                    },
                                                    success: function (result) {},
                                                    error: function (result) {
                                                        alert(JSON.stringify(result));
                                                    }
                                                });
                                            }
                                        }

                                    }
                                    if (confirm("Güncelleme yapmak istediğinize emin misiniz?")) {
                                        var url = window.location.toString();
                                        if (url.charAt(url.length - 1) == 't') {
                                            if (confirm("Telefon Araması Yapıldı Mı?")) {
                                                var targetUrl = '/misc/telefonAramasiIsle/';
                                                $.ajax({
                                                    url: targetUrl,
                                                    type: 'get',
                                                    data: {
                                                        musteriID: musteriId
                                                    },
                                                    success: function (result) {},
                                                    error: function (result) {
                                                        alert(JSON.stringify(result));
                                                    }
                                                });

                                            }
                                        }
                                        return true;

                                    } else {
                                        return false;
                                    }

                                });
                            });

                        </script>

                        <button class="btn btn-primary mt-4 shadow">Güncelle</button>
                        <a name="" id="" data-toggle="modal" data-target="#Dosyalar"
                            class="btn btn-secondary mt-4 shadow" href="#" role="button">Dosyalar</a>
                        <input type="hidden" name="from" id="from">

                    </form>


                </div>

            </div>

            <script>
                var lastChar = $(location).attr('href').charAt($(location).attr('href').length - 1)
                var lastChar2 = $(location).attr('href').charAt($(location).attr('href').length - 2)
                if (lastChar == 'h' || lastChar == 'p') {
                    document.getElementById('from').value = lastChar;
                }
                if (lastChar2 == 'h' || lastChar2 == 'p') {
                    document.getElementById('from').value = lastChar2;
                }

            </script>
            @if ($rt_mi ?? '' == 1)
            <div class="card border-primary">
                <div class="card-body">
                    <h4 class="card-title">Borç Durumu</h4>
                    <div class="row mb-1">
                        <div class="col d-flex">
                            @if ($musteri->bakiye_durum == 1)
                            <a name="" id="" data-toggle="modal" data-target="#Tahsilat" class="btn btn-success mr-1"
                                href="#" role="button">Tahsilat</a>
                            <a name="" id="" data-toggle="modal" data-target="#Borclandir" class="btn btn-danger"
                                href="#" role="button">Borçlandır</a>
                            @endif
                        </div>
                        <div class="col" style="font-size: 12pt">

                            @if ($musteri->bakiye_durum == 1)
                            <span class="small"> Bakiye Durum:</span> <span style="color: green">Açık</span>
                            @else
                            <span class="small"> Bakiye Durum:</span> <span style="color: red">Kapalı
                            </span>
                            @endif
                        </div>
                        <div class="col">
                            @if ($musteri->bakiye_durum == 1)
                            <a name="" id="" data-toggle="modal" onclick="bakiyeKapat({{$musteri->id}})"
                                class="btn btn-danger" href="#" role="button">Bakiyeyi Kapat</a>
                            @else
                            <a name="" id="" data-toggle="modal" onclick="bakiyeAc({{$musteri->id}})"
                                class="btn btn-success" href="#" role="button">Bakiyeyi Aç</a>
                            @endif
                        </div>
                        <div class="col text-right">
                            @if ($musteri->bakiye < 0) Bakiye: <strong>
                                <span style="color:red">
                                    {{ $musteri->bakiye }}TL
                                    </strong>
                                </span>
                                @elseif($musteri->bakiye == 0)
                                <span style="color:green">
                                    Borcu Yoktur
                                </span>
                                @else
                                <span style="color:green">
                                    {{ $musteri->bakiye }}TL

                                </span>
                                @endif
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tutar</th>
                                <th>Borç/Alacak</th>
                                <th>Tarih</th>
                                @if ($rt_mi == true)
                                <th>Bilgi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($muhasebe as $item)

                            <tr>
                                <td scope="row">
                                    @if ($item->BA == 'B')
                                    <span style="color:red">
                                        {{ $item->tutar }}
                                    </span>
                                    @else
                                    <span style="color:green">
                                        {{ $item->tutar }}
                                    </span>
                                    @endif
                                </td>
                                <td scope="row">
                                    @if ($item->BA == 'B')
                                    Borç
                                    @else
                                    Alacak
                                    @endif

                                </td>
                                <td scope="row"> {{ date_format($item->created_at,"d/m/Y H:i") }}</td>
                                @if ($item->duzeltme == 'true')
                                <td>
                                    <span style="color:red">Düzeltme</span>
                                </td>
                                @endif
                                @if ($rt_mi == true)
                                <td>

                                    <a onclick="bilgiPopup({{ $item->id }})" style="cursor:pointer">
                                        <i class="fa fa-info-circle" style="font-size:17pt" aria-hidden="true"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
            @else

            @endif

        </div>
    </div>
</div>
<div class="modal fade" id="Dosyalar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Dosyalar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 d-flex justify-content-center">
                <form action="{{ url('dosyaKaydet') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="musteri_id" name="musteri_id" value="{{ $musteri->id }}">
                    <input type="hidden" id="oldDurumId" value="{{ $musteri->durum }}">
                    <div class="row">
                        @if ($musteri->f1 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Girişimcilik
                                Belgesi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f1" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f1">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Girişimcilik
                                    Belgesi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f1" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f2 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Vergi
                                Levhası</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f2" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f2">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Vergi
                                    Levhası</span>
                                <div class="div mt-2">
                                    <input type="file" name="f2" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f3 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Oda
                                Kaydı</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f3" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f3">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Oda
                                    Kaydı</span>
                                <div class="div mt-2">
                                    <input type="file" name="f3" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f4 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Faaliyet
                                Belgesi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f4" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f4">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Faaliyet
                                    Belgesi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f4" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f5 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Sicil
                                Gazetesi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f5" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f5">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Sicil
                                    Gazetesi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f5" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f6 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Kobi
                                Beyannamesi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f6" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f6">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Kobi
                                    Beyannamesi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f6" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f7 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Vergi
                                Mükellefiyet Belgesi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f7" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f7">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Vergi
                                    Mükellefiyet Belgesi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f7" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f8 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Proforma
                                Faturalar (Sıkıştırılmış Arşiv)</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f8" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f8">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Proforma
                                    Faturalar (Sıkıştırılmış Arşiv)</span>
                                <div class="div mt-2">
                                    <input type="file" name="f8" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f9 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">İş
                                Modeli</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f9" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f9">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">İş
                                    Modeli</span>
                                <div class="div mt-2">
                                    <input type="file" name="f9" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f10 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Başvuru
                                Formu</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f10" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f10">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Başvuru
                                    Formu</span>
                                <div class="div mt-2">
                                    <input type="file" name="f10" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f11 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Kurul Kararı
                                Formu</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f11" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f11">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Kurul
                                    Kararı Formu</span>
                                <div class="div mt-2">
                                    <input type="file" name="f11" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f12 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Kuruluş
                                Talebi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f12" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f12">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Kuruluş
                                    Talebi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f12" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f13 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Makine
                                Talebi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f13" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f13">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Makine
                                    Talebi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f13" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f14 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Performans
                                Talebi</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f14" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f14">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Performans
                                    Talebi</span>
                                <div class="div mt-2">
                                    <input type="file" name="f14" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f15 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer 1</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f15" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f15">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    1</span>
                                <div class="div mt-2">
                                    <input type="file" name="f15" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f16 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer 2</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f16" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f16">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    2</span>
                                <div class="div mt-2">
                                    <input type="file" name="f16" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f17 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer
                                3</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f17" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f17">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    3</span>
                                <div class="div mt-2">
                                    <input type="file" name="f17" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f18 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer
                                4</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f18" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f18">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    4</span>
                                <div class="div mt-2">
                                    <input type="file" name="f18" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f19 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer
                                5</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f19" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f19">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    5</span>
                                <div class="div mt-2">
                                    <input type="file" name="f19" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($musteri->f20 != null)
                        <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                            <span class="dosyaAdi">Diğer
                                6</span>
                            <div class="div">
                                <a href="/dosyaIndir/{{ $musteri->id }}/f20" style="font-size: 16pt">indir</a>
                                <a href="/dosyaSil/{{ $musteri->id }}/f20">
                                    <i class="fa fa-trash-o" style="font-size: 16pt;color: red;margin-left:50px"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                        @else
                        <div class="mb-2">
                            <div class="p-2 col d-flex flex-column border dosyaRow mb-2">
                                <span class="dosyaAdi">Diğer
                                    6</span>
                                <div class="div mt-2">
                                    <input type="file" name="f20" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <input type="submit" value="Kaydet" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sifreInputModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col">
                        <h5 class="modal-title" id="exampleModalLongTitle">Güvenlik Şifresini Girin</h5>
                    </div>

                </div>
                <div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <script>
                        $(function () {

                            $("#guvenlikSifresiInput").keydown(function (e) {
                                if (e.which == 13) {
                                    sifreDogru();
                                } else {
                                    return;
                                }
                            });

                        });

                    </script>
                    <input type="number" class="form-control" autofocus name="guvenlikSifresiInput"
                        id="guvenlikSifresiInput" aria-describedby="helpId" placeholder="">
                </div>
                <br>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-primary" onclick="sifreDogru()">Doğrula</button>
            </div>
        </div>
    </div>
</div>
<div class=" modal fade" id="Tahsilat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tahsilat</h5>
                    </div>

                </div>
                <div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tahsilatInput">Tutar</label>
                    <input type="number" class="form-control" name="tahsilatInput" id="tahsilatInput"
                        aria-describedby="helpId" placeholder="">
                </div>
                <br>

                <div class="form-group">

                    <div class="col d-flex">
                        <input type="checkbox" style="zoom:1.5" name="duzeltme" id="duzeltme"> &nbsp;
                        <label for="duzeltme" style="font-size: 13pt">Düzeltme</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-primary" onclick="Tahsilat()" data-dismiss="modal">Kaydet</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Borclandir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Borçlandır</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="borclandirInput">Tutar</label>
                    <input type="number" class="form-control" name="borclandirInput" id="borclandirInput"
                        aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">

                    <div class="col d-flex">
                        <input type="checkbox" style="zoom:1.5" name="borclandirduzeltme" id="borclandirduzeltme">
                        &nbsp;
                        <label for="borclandirduzeltme" style="font-size: 13pt">Düzeltme</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-primary" onclick="Borclandir()"
                    data-dismiss="modal">Kaydet</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tahsilatInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hareket İncele</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <input type="hidden" name="hareketIdHidden" id="hareketIdHidden">
                        <tr>
                            <th>BA</th>
                            <th>Tutar</th>
                            <th>Tarih</th>
                            <th>Düzeltme</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="baTD"></td>
                            <td id="tutarTD">B</td>
                            <td id="tarihTD">B</td>
                            <td id="duzeltmeTD">B</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    onclick="hareketSil(document.getElementById('hareketIdHidden').value)">Sil</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="musteri_id" id="musteri_id" value="{{$musteri->id}}">
<textarea name="copyArea" id="copyArea" style="height:0px" cols="30" rows="10"></textarea>
