@include('layouts.app')


<div class="row pl-3 animated fadeIn">

    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <h4>Arama Sonuçları</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kod</th>
                                    <th scope="col">İsim</th>
                                    <th scope="col">Bitirilen Görev Sayısı</th>
                                    <th scope="col">Sektör</th>
                                    <th scope="col">Telefon</th>
                                    <th scope="col">Durum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bulunanKullanicilar as $tm)

                                <tr>


                                    <th scope="row"><a href="/portfolyo/musteri/{{ $tm->id }}"> {{ $tm->id  }} </a>

                                    </th>
                                    <td> {{ $tm->name  }}
                                    </td>
                                    <td> {{ $tm->sehir  }}
                                    </td>
                                    <td>
                                        {{ $tm->sektor  }}
                                    </td>
                                    <td>
                                        {{ $tm->newtelefon  }}
                                    </td>
                                    <td>
                                        {{-- 0- Görüşülmedi 1- Görüşüldü 2- Referans Verildi 3- Sözleşmesi Yapıldı 4- Projesine Başlandı 5- Dosyası Tamamlandı --}}
                                        @switch($tm->durum)
                                        @case(0)
                                        Görüşülmedi
                                        @break
                                        @case(1)
                                        Görüşüldü
                                        @break
                                        @case(2)
                                        Referans Verildi
                                        @break
                                        @case(3)
                                        Sözleşmesi Yapıldı
                                        @break
                                        @case(4)
                                        Projesine Başlandı
                                        @break
                                        @case(5)
                                        Dosyası Tamamlandı
                                        @break
                                        @default

                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $bulunanKullanicilar->links() }}

                    </div>

                </div>

            </div>

        </div>
    </div>
