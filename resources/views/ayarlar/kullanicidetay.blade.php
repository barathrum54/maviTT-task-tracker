@include('layouts.app')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <strong>
                        {{ $user->name }}
                    </strong>
                    &nbsp;
                    Son Görülme:
                    <strong>
                        {{ date('H:i  ',strtotime($user->songiris)) }}

                    </strong>

                    {{ date('d/m/Y ',strtotime($user->songiris)) }}

                </div>
                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">
                                    <h4>
                                        Bitirilmiş Projeler
                                    </h4>
                                </th>
                                <th scope="col">
                                    <h4>
                                        Aktif Projeler
                                    </h4>
                                </th>
                                <th scope="col">
                                    <h4>
                                        İptal Edilen Projeler
                                    </h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h3> {{ $bitirilenGorev }} </h3>
                                </td>
                                <td>
                                    <h3>
                                        {{ $AktifProjeler }}
                                    </h3>
                                </td>
                                <td>
                                    <h3>
                                        {{ $iptalGorev }}
                                    </h3>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Kod</th>
                                <th scope="col">İsim</th>
                                <th scope="col">Şehir</th>
                                <th scope="col">Sektör</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tumMusteriler as $tm)

                            <tr>
                                <th scope="row"><a href="/portfolyo/musteri/{{ $tm->id }}"> {{ $tm->id  }} </a>

                                </th>
                                <td> {{ $tm->isim  }}
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
                                    @foreach ($durumlar as $durum)
                                    @if ($durum->id == $tm->durum)
                                    {{ $durum->durum_aciklama }}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- <h1>Görev Detayları</h1>

<strong>Açıklama</strong>
<p>{{ $task->ACIKLAMA }}</p>

<strong>Notlar</strong>

<p>{{ $task->NOTLAR }}</p>

<div>
    <a href="/tasks/{{ $task->id }}/edit">Düzenle</a>
    <form action="/tasks/{{ $task->id }}" method="post">
        @method('DELETE')

        <button>Sil</button>
        @csrf
    </form>
</div> --}}
