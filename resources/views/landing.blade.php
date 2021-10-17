@extends('layouts.app')

@section('content')
<style>
    body {
        overflow: hidden;
    }

    @media (max-width: 576px) {

        body {
            overflow-y: scroll;
        }
    }

</style>
<div class="background-img">
    <img src="/img/bg-2.jpg">
</div>
<div class="container animated fadeIn pt-5">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 px-1">
            @if ($rt_mi == true)
            <div class="card">
                <div class="card-header text-center" style="font-size:24px">
                    Günlük Rapor <i class="fa fa-info-circle" aria-hidden="true"></i> </div>
                <div class="card-body" style="font-size:12pt">
                    <div class="row pl-3 border mb-1">
                        <strong>{{ $bugunEklenenMusteriSayisi }}</strong> &nbsp; Müşteri Eklendi
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong>{{ $bugunGuncellenenMusteriSayisi }}</strong> &nbsp; Müşteri Güncellendi
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong>{{ $bugunArananMusteriSayisi }}</strong> &nbsp; Müşteri Arandı
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong style="color: red">{{ $bugunSilinenIslerSayisi }}</strong> &nbsp; Müşteri Kaydı Silindi
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong style="color: blue">{{ $bugunTamamlananIslerSayisi }}</strong> &nbsp; Proje Tamamlandı
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong style="color: green">{{ $bugunYapilanTahsilat }} TL</strong> &nbsp; Tahsilat yapıldı
                    </div>
                    <div class="row pl-3 border mb-1">
                        <strong style="color: red">{{ $bugunAcilanBorc }} TL</strong> &nbsp; Borç Açıldı
                    </div>
                </div>
            </div>
            @endif
            <div class="card pt-1">
                <div class="card-header text-center" style="font-size:24px">
                    Önemli Dosyalar <i class="fa fa-exclamation" aria-hidden="true"></i> </div>
                <div class="card-body ">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Atanmış</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Tümü</a>
                        </li>

                    </ul>
                    <div class="tab-content " id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <ul class="list-group"
                                style="max-height: 200px !important;overflow-y:scroll;overflow-x:hidden">
                                @foreach ($onemliDosyalarAtanan as $musteri)
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4>{{ $musteri->isim }}</h4>
                                        <p>{{ $musteri->newtelefon }}</p>
                                        <p class="card-text">Durum: <span style="color: red">Görüşülmedi</span>
                                    </div>
                                    <div class="col-md-2 d-flex flex-column justify-content-center">
                                        <a href="/portfolyo/musteri/{{ $musteri->id }}h">
                                            <i class="animated fadeIn"
                                                style="font-family:unset;font-size:20pt;opacity:.5"
                                                aria-hidden="true"><i class="fa fa-cog" style="color:red"
                                                    aria-hidden="true"></i></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <ul class="list-group"
                                style="max-height: 200px !important;overflow-y:scroll;overflow-x:hidden">
                                @foreach ($onemliDosyalarTumu as $musteri) <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4>{{ $musteri->isim }}</h4>
                                            <p>{{ $musteri->newtelefon }}</p>
                                            <p class="card-text">Durum: <span style="color: red">Görüşülmedi</span>

                                        </div>
                                        <div class="col-md-2 d-flex flex-column justify-content-center">
                                            <a href="/portfolyo/musteri/{{ $musteri->id }}h">
                                                <i class="animated fadeIn"
                                                    style="font-family:unset;font-size:20pt;opacity:.5"
                                                    aria-hidden="true"><i class="fa fa-cog" style="color:red"
                                                        aria-hidden="true"></i></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 px-1 landingComponentOuter ">
            <div class="card ">
                <div class="card-header text-center" style="font-size:24px">
                    Telefon Aramaları <i class="fas fa-phone"></i></div>
                <div class="card-body landingComponent">
                    <ul class="list-group ">
                        @forelse ($telefonGorusmeleri as $musteri)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4>{{ $musteri->isim }}</h4>
                                    <p>{{ $musteri->newtelefon }}</p>
                                    <p class="card-text">Durum: <span style="color: red">Görüşülmedi</span>
                                        <br>
                                        <small>Arama Yapıp Bilgi Alınız</small></p>
                                </div>
                                <div class="col-md-2 d-flex flex-column justify-content-center">
                                    <a href="/portfolyo/musteri/{{ $musteri->id }}t">
                                        <i class="animated fadeIn" style="font-family:unset;font-size:20pt;opacity:.5"
                                            aria-hidden="true"><i class="fa fa-cog" aria-hidden="true"></i></i>
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="row">
                                <div class="text-center">
                                    <span>Hiç Telefon Görüşmeniz Bulunmuyor</span>
                                </div>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 px-1">
            <div class="card ">
                <div class="card-header shadow-sm text-center"><span style="font-size: 24px">Aktif Projeler <i
                            class="fa fa-cogs" aria-hidden="true"></i></span></div>
                <div class="card-body aktif-projeler landingComponent">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#agSonGuncellenenler"
                                role="tab" aria-controls="agSonGuncellenenler" aria-selected="true">Son
                                Güncellenenler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#agTumu" role="tab"
                                aria-controls="agTumu" aria-selected="false">Tümü</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="agSonGuncellenenler" role="tabpanel"
                            aria-labelledby="home-tab">
                            <ul class="list-group">
                                @forelse ($aktifProjelerSG as $musteri)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4>{{ $musteri->isim }}</h4>
                                            <p>{{ $musteri->newtelefon }}</p>
                                            <p class="card-text">Durum: @foreach ($durumlar as $durum)
                                                @if ($durum->id == $musteri->durum)
                                                <span>

                                                    {{ $durum->durum_aciklama }}
                                                </span>
                                                <div class="text" style="font-size: 12pt">
                                                    <strong>
                                                        {{ date_format( $musteri->updated_at," H:i") }}
                                                    </strong>
                                                    {{ date_format( $musteri->updated_at,"d/m/Y") }}
                                                </div>
                                                @endif
                                                @endforeach</span>
                                        </div>
                                        <div class="col-md-2 d-flex flex-column justify-content-center">
                                            <a href="/portfolyo/musteri/{{ $musteri->id }}h">
                                                <i class="animated fadeIn"
                                                    style="font-family:unset;font-size:20pt;opacity:.5"
                                                    aria-hidden="true"><i class="fa fa-cog" aria-hidden="true"></i></i>
                                            </a>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="text-center">
                                            <span>Hiç Telefon Görüşmeniz Bulunmuyor</span>
                                        </div>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="agTumu" role="tabpanel" aria-labelledby="profile-tab">
                            <ul class="list-group">
                                @forelse ($aktifProjeler as $musteri)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4>{{ $musteri->isim }}</h4>
                                            <p>{{ $musteri->newtelefon }}</p>
                                            <p class="card-text">Durum: @foreach ($durumlar as $durum)
                                                @if ($durum->id == $musteri->durum)
                                                <span>

                                                    {{ $durum->durum_aciklama }}
                                                </span>

                                                @endif
                                                @endforeach</span>
                                        </div>
                                        <div class="col-md-2 d-flex flex-column justify-content-center">
                                            <a href="/portfolyo/musteri/{{ $musteri->id }}h">
                                                <i class="animated fadeIn"
                                                    style="font-family:unset;font-size:20pt;opacity:.5"
                                                    aria-hidden="true"><i class="fa fa-cog" aria-hidden="true"></i></i>
                                            </a>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="text-center">
                                            <span>Hiç Telefon Görüşmeniz Bulunmuyor</span>
                                        </div>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    {{-- @forelse ($aktifProjeler as $ag)
                    <div class="d-flex justify-content-between shadow border m-1 p-0 aktif-proje-item">
                        <div class="col-lg-5 col-sm-4 d-flex flex-column">
                            <span class="text-muted" style="font-size: 9pt">Müşteri Adı</span>
                            <span>
                                {{ $ag->isim }}
                    </span>
                </div>
                <div class="col-lg-5 col-sm-4 d-flex flex-column ">
                    <span class="text-muted" style="font-size: 9pt">Durum</span>
                    @foreach ($durumlar as $durum)
                    @if ($durum->id == $ag->durum)
                    <span>

                        {{ $durum->durum_aciklama }}
                    </span>
                    @endif
                    @endforeach
                </div>
                <div class="col-lg-4 col-sm-4">

                    <form action="/portfolyo/musteri/{{ $ag->id }}h" method="GET">
                        <button class="btn btn-light border"
                            style="width:100%;background-color:rgba(37, 165, 5, 0.534);">
                            <span class="text-nowrap" style="font-size: 18pt;color:white;font-weight:bold"><i
                                    class="fa fa-cogs" aria-hidden="true"></i></span>
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="text-center d-flex flex-column">
                <i class="fa fa-exclamation text-muted" style="font-size:35pt;opacity:.2;" aria-hidden="true"></i>
                <span>Hiç Projeniz Bulunmuyor</span>
            </div>
            @endforelse --}}
        </div>
    </div>
</div>

@endsection
