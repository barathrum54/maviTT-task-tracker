@include('layouts.app')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4" style="display:flex !important; flex-flow: row !important">
                <div class="card-body">
                    <table class="table table-striped border table-bordered">
                        <thead>
                            <tr>
                                <th style="font-size:12pt">Kullanıcı Adı</th>
                                <th style="font-size:12pt">Bu Hafta</th>
                                <th style="font-size:8pt">Bitirilen Projeler(Bu Ay)</th>
                                <th style="font-size:10pt">Bitirilen Görev(Toplam)</th>
                                <th style="font-size:10pt">Aktif Projeler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                @foreach ($newUsers as $index => $user)

                                <td>
                                    <a style="font-size:12pt;" href="/ayarlar/kullanicilar/{{ $user->id }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>
                                    <span class="text-center" style="font-size:14pt;">
                                        {{ $user->BuHaftaBitirilen }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-center" style="font-size:14pt;">
                                        {{ $user->BuAyBitirilen }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-center" style="font-size:14pt;">
                                        {{ $user->ToplamBitirilen }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-center" style="font-size:14pt;">
                                        {{ $user->AktifProjeler }}
                                    </span>
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

{{-- <div class="container mt-4">
     <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4" style="display:flex !important; flex-flow: row !important">
                <div class="card-body">
                    <table class="table table-striped border table-bordered">
                        <thead>

                            <tr>
                                <th style="font-size:12pt">Kullanıcı Adı</th>
                                <th style="font-size:12pt">Bu Hafta</th> 
                                <th style="font-size:8pt">Bitirilen Projeler(Bu Ay)</th> 
                                <th style="font-size:10pt">Bitirilen Görev(Toplam)</th>
                                <th style="font-size:10pt">Aktif Projeler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                @foreach ($newUsers as $index => $user)

                                <td>
                                    <a style="font-size:12pt;" href="/ayarlar/kullanicilar/{{ $user->id }}">
{{ $user->name }}
</a>
</td>
<td>
    <span class="text-center" style="font-size:14pt;">
        {{ $user->BuHaftaBitirilen }}
    </span>
</td>
<td>
    <span class="text-center" style="font-size:14pt;">
        {{ $user->BuAyBitirilen }}
    </span>
</td>
<td>
    <span class="text-center" style="font-size:14pt;">
        {{ $user->ToplamBitirilen }}
    </span>
</td>
<td>
    <span class="text-center" style="font-size:14pt;">
        {{ $user->AktifProjeler }}
    </span>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div> --}}
