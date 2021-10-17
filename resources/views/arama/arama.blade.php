    @include('layouts.app')
    <style>
        .card-body {
            display: flex;
            justify-content: center;
            align-content: center
        }

        tbody>tr>td {
            border: 1pt solid rgba(0, 0, 0, 0.1);
            padding: 5px !important;
            max-height: 10px !important;
            font-size: 15px;
        }

    </style>
    <script>
        function filtrele() {
            durum = document.getElementById('filtreDurum').value;
            isim = document.getElementById('isim').value;
            sehir = document.getElementById('sehir').value;
            sektor = document.getElementById('sektor').value;
            atanan = document.getElementById('atanan').value;
            bakiye = document.getElementById('bakiye').value;
            onemSirasi = document.getElementById('onemSirasi').value;

            sonTahsilat = document.getElementById('sonTahsilat').value;
            url = '/filtrele?' + 'durum=' + durum + '&' + 'isim=' + isim + '&' + 'sehir=' + sehir + '&' + 'sektor=' +
                sektor + '&' + 'atanan=' + atanan + '&' + 'bakiye=' + bakiye + '&' + 'sonTahsilat=' + sonTahsilat +
                '&' + 'onemSirasi=' + onemSirasi;
            aramaText = document.getElementById('aramaText').value;
            window.location.href = url;

        }

    </script>
    <div class="modal fade" id="filtreModal" tabindex="-1" role="dialog" aria-labelledby="filtreModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Filtrele</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row d-flex flex-column p-2">
                        <label for="filtreDurum">Durum</label>
                        <select name="filtreDurum" id="filtreDurum">
                            <option {{old('filtreDurum',$durum ?? '')=="0"? 'selected':''}} value="99">
                                Tümü</option>
                            @foreach ($durumlar as $durum)
                            <option {{old('filtreDurum',$durum ?? '')=="$durum->id"? 'selected' :''}}
                                value="{{ $durum->id }}">
                                {{ $durum->durum_aciklama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="isim">İsim</label>
                        <input type="text" id="isim" name="isim" value="{{ $isim ?? ''}}">
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="sehir">Şehir</label>

                        <input type="text" id="sehir" value="{{$sehir ?? ''}}">
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="sektor">Sektör</label>
                        <input type="text" id="sektor" value="{{ $sektor ?? ''}}">
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="atanan">Atanan</label>
                        <select class="form-control" name="atanan" id="atanan">
                            <option value="99">Tümü</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="atanan">Önem Sırası</label>
                        <select class="form-control" name="onemSirasi" id="onemSirasi">
                            <option value="0">
                                Belirtilmemiş</option>
                            <option value="1" style="background-color:green;color:white">
                                Yeşil</option>
                            <option value="2" style="background-color:rgb(255, 255, 0);color:green">
                                Sarı
                            </option>
                            <option value="3" style="background-color:red;color:white">
                                Kırmızı</option>
                        </select>
                    </div>

                    <div class="row d-flex flex-column p-2">
                        <label for="bakiye">Bakiye</label>
                        <select class="form-control" name="bakiye" id="bakiye">
                            <option value="null">Seçilmemiş</option>
                            <option value="artan">Artan</option>
                            <option value="azalan">Azalan</option>
                        </select>
                    </div>
                    <div class="row d-flex flex-column p-2">
                        <label for="sonTahsilat">Son Tahsilat Süresi</label>
                        <select class="form-control" name="sonTahsilat" id="sonTahsilat">
                            <option value="null">Seçilmemiş</option>
                            <option value="artan">Artan</option>
                            <option value="azalan">Azalan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <input type="submit" onclick="filtrele()" class="btn btn-primary" value="Filtreli Ara">
                </div>
            </div>
        </div>
    </div>

    <div class="background-img">
        <img src="/img/bg-1.jpg">
    </div>
    <div class="row animated fadeIn mb-2">
        <div class="col-md-12 d-flex justify-content-center mt-5">
            <a href="/portfolyo/musteriEkle" class="mr-3">
                <button class="btn btn-primary">Yeni Ekle</button>
            </a>
            <form id=arama action="/arama" method="get" class="d-flex">
                @csrf
                <input class="form-control" style="width: 600px" id="aramaText" name="aramaText" type="text"
                    placeholder="..." aria-label="Search">
                <button class="btn btn-light ml-1">Ara</button>
            </form>
        </div>
    </div>
    <div class="row animated fadeIn">

        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4>Son Güncellenenler <br><small class="text-muted">
                                            {{ count($bulunanMusteriler) }} sonuç.
                                        </small></h4>
                                </div>

                                <button type="button" class="btn mr-3" data-toggle="modal" data-target="#filtreModal"
                                    style="background-color: blueviolet;color:white">
                                    Filtrele <i class="fa fa-filter" aria-hidden="true"></i>
                                </button>

                                @if ($rt_mi == true)

                                @endif
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table-striped">
                                <thead>

                                    <tr>
                                        <th scope="col">Kod</th>
                                        <th scope="col">İsim</th>
                                        <th scope="col">Şehir</th>
                                        <th scope="col">Sektör</th>
                                        <th scope="col">Önem Derecesi</th>
                                        <th scope="col">Telefon</th>
                                        <th scope="col">Durum</th>
                                        <th scope="col">Son Güncelleme</th>
                                        @if ($rt_mi == true)
                                        <th scope="col">Bakiye</th>
                                        <th scope="col">Son Tahsilat</th>
                                        @else

                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bulunanMusteriler as $tm)



                                    <th scope="row"><a href="/portfolyo/musteri/{{ $tm->id }}p"> {{ $tm->id  }} </a>

                                    </th>
                                    <td> {{ $tm->isim}}
                                    </td>
                                    <td class="text-nowrap text-truncate"
                                        style="max-width: 100px !important;min-width:70px !important">
                                        {{ $tm->sehir}}
                                    </td>
                                    <td>
                                        {{ $tm->sektor}}
                                    </td>
                                    <td>
                                        @if ($tm->onemSirasi == null || $tm->onemSirasi == 0)
                                        <div class="muted" style="opacity: .5">Belirsiz</div>
                                        @endif
                                        @if ($tm->onemSirasi == 1)
                                        <div class="d-flex justify-content-center align-items-center" style="font-weight:bold;text-align:center;border-radius:15px;height:100%;background-color:
                                                rgba(0, 128, 0, 0.63);color:white">
                                            <span>Yeşil</span>
                                        </div>
                                        @endif
                                        @if ($tm->onemSirasi == 2)
                                        <div class="d-flex justify-content-center align-items-center" style="font-weight:bold;text-align:center;border-radius:15px;height:100%;background-color:
                                                rgba(238, 255, 0, 0.63);color:green">
                                            <span>Sarı</span>
                                        </div>
                                        @endif
                                        @if ($tm->onemSirasi == 3)
                                        <div class="d-flex justify-content-center align-items-center" style="font-weight:bold;text-align:center;border-radius:15px;height:100%;background-color:
                                                rgba(255, 0, 0, 0.63);color:white">
                                            <span>Kırmızı</span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $tm->newtelefon  }}
                                    </td>
                                    <td
                                        style="width:150px;text-align:center;font-size:10pt;opacity:.8;font-weight:bold">
                                        @foreach ($durumlar as $durum)
                                        @if ($durum->id == $tm->durum)
                                        {{ $durum->durum_aciklama }}
                                        @endif
                                        @endforeach

                                    </td>
                                    <td>
                                        <div class="text" style="font-size: 9pt">
                                            <strong>
                                                {{ date_format( $tm->updated_at," H:i") }}
                                            </strong>
                                            {{ date_format( $tm->updated_at,"d/m/Y") }}

                                        </div>
                                    </td>
                                    @if ($rt_mi == true)
                                    <td style="background-color: rgba(255, 255, 255, 0.7)">
                                        @if ($tm->bakiye_durum == 0)
                                        <strong style="color: red">X</strong>
                                        @endif
                                        @if($tm->bakiye < 0) <span style="color:red">
                                            {{ $tm->bakiye  }} TL
                                            </span>
                                            @elseif($tm->bakiye >= 0)
                                            <span style="color:green;">
                                                {{ $tm->bakiye  }} TL
                                            </span>
                                            @else
                                            {{ $tm->bakiye  }} TL

                                            @endif
                                    </td>
                                    @if ($tm->sonTahsilat != null)
                                    <td style="background-color: rgba(255, 255, 255, 0.7)">
                                        <div class="text" style="font-size: 10pt">
                                            <strong>
                                                {{ date_format( new DateTime($tm->sonTahsilat),"d/m/Y") }}
                                            </strong>

                                        </div>
                                    </td>
                                    @else
                                    <td style="background-color: rgba(255, 255, 255, 0.7)" class="text-muted">
                                        Belirsiz</td>
                                    @endif
                                    @else

                                    @endif
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer">
                                {{ $enSon->links() }}

                    </div> --}}

                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
