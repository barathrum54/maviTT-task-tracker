    @include('layouts.app')

    <div class="mb-4">&nbsp;</div>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                href="#nav-ana1" role="tab" aria-controls="nav-home"
                                                aria-selected="true">Şehire Göre Dağılım</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                href="#nav-ana2" role="tab" aria-controls="nav-profile"
                                                aria-selected="false">Aylara Göre Dağılım</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                                href="#nav-ana3" role="tab" aria-controls="nav-contact"
                                                aria-selected="false">Sektöre Göre Dağılım</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                                href="#nav-ana4" role="tab" aria-controls="nav-contact"
                                                aria-selected="false">Duruma Göre Dağılım</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-ana1" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 ">
                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                            role="tablist">
                                                                            <a class="nav-item nav-link active"
                                                                                id="nav-home-tab" data-toggle="tab"
                                                                                href="#nav-home" role="tab"
                                                                                aria-controls="nav-home"
                                                                                aria-selected="true">Çubuk Grafik</a>
                                                                            <a class="nav-item nav-link"
                                                                                id="nav-profile-tab" data-toggle="tab"
                                                                                href="#nav-profile" role="tab"
                                                                                aria-controls="nav-profile"
                                                                                aria-selected="false">Pasta Grafik</a>
                                                                            <a class="nav-item nav-link"
                                                                                id="nav-contact-tab" data-toggle="tab"
                                                                                href="#nav-contact" role="tab"
                                                                                aria-controls="nav-contact"
                                                                                aria-selected="false">Tablo Grafik</a>
                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active"
                                                                            id="nav-home" role="tabpanel"
                                                                            aria-labelledby="nav-home-tab">
                                                                            <canvas id="myChart" width="1000"
                                                                                height="500"></canvas>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-profile"
                                                                            role="tabpanel"
                                                                            aria-labelledby="nav-profile-tab">
                                                                            <canvas id="myChart2" width="1000"
                                                                                height="500"></canvas>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-contact"
                                                                            role="tabpanel"
                                                                            aria-labelledby="nav-contact-tab">
                                                                            <div class="table-responsive ">
                                                                                <table id="tablo1"
                                                                                    class="table table-striped table-inverse table-responsive table-hover w-100 d-block d-md-table">
                                                                                    <thead class="thead-inverse">
                                                                                        <tr>
                                                                                            <th>Şehir</th>
                                                                                            <th>Sayı</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        @foreach ($sehirSayisi as $sehir
                                                                                        =>
                                                                                        $sayi)

                                                                                        <tr>
                                                                                            <td scope="col">{{ $sehir }}
                                                                                            </td>
                                                                                            <td scope="col text-left">
                                                                                                {{ $sayi }}</td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-ana2" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 ">
                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                            role="tablist">
                                                                            <a class="nav-item nav-link active"
                                                                                id="nav-home-tab" data-toggle="tab"
                                                                                href="#nav-home2" role="tab"
                                                                                aria-controls="nav-home"
                                                                                aria-selected="true">Çubuk Grafik</a>
                                                                            <a class="nav-item nav-link"
                                                                                id="nav-profile-tab" data-toggle="tab"
                                                                                href="#nav-profile2" role="tab"
                                                                                aria-controls="nav-profile"
                                                                                aria-selected="false">Pasta Grafik</a>
                                                                            <a class="nav-item nav-link"
                                                                                id="nav-contact-tab" data-toggle="tab"
                                                                                href="#nav-contact2" role="tab"
                                                                                aria-controls="nav-contact"
                                                                                aria-selected="false">Tablo Grafik</a>
                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active"
                                                                            id="nav-home2" role="tabpanel"
                                                                            aria-labelledby="nav-home-tab">
                                                                            <canvas id="myChart2-1" width="1000"
                                                                                height="500"></canvas>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-profile2"
                                                                            role="tabpanel"
                                                                            aria-labelledby="nav-profile-tab">
                                                                            <canvas id="myChart2-2" width="1000"
                                                                                height="500"></canvas>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-contact2"
                                                                            role="tabpanel"
                                                                            aria-labelledby="nav-contact-tab">
                                                                            <div class="table-responsive ">
                                                                                <table id="tablo2"
                                                                                    class="table table-striped table-inverse table-responsive table-hover w-100 d-block d-md-table">
                                                                                    <thead class="thead-inverse">
                                                                                        <tr>
                                                                                            <th>Ay</th>
                                                                                            <th>Sayı</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        @foreach ($aySayisi as $month
                                                                                        => $sayi)

                                                                                        <tr>
                                                                                            <td scope="col">
                                                                                                {{ $month }}
                                                                                            </td>
                                                                                            <td scope="col text-left">
                                                                                                {{ $sayi }}</td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-ana3" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 ">
                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                            role="tablist">
                                                                            <a class="nav-item nav-link active"
                                                                                id="nav-contact-tab" data-toggle="tab"
                                                                                href="#nav-contact2" role="tab"
                                                                                aria-controls="nav-contact"
                                                                                aria-selected="false">Tablo Grafik</a>
                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content" id="nav-tabContent">

                                                                        <div class="tab-pane fade show active"
                                                                            id="nav-contact2" role="tabpanel"
                                                                            aria-labelledby="nav-contact-tab">
                                                                            <div class="table-responsive ">
                                                                                <table id="tablo3"
                                                                                    class="table table-striped table-inverse table-responsive table-hover w-100 d-block d-md-table">
                                                                                    <thead class="thead-inverse">
                                                                                        <tr>
                                                                                            <th>Sektör</th>
                                                                                            <th>Sayı</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        @foreach ($sektorSayisi as
                                                                                        $sektor
                                                                                        => $sayi)

                                                                                        <tr>
                                                                                            <td scope="col">
                                                                                                {{ $sektor }}
                                                                                            </td>
                                                                                            <td scope="col text-left">
                                                                                                {{ $sayi }}</td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-ana4" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 ">
                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                            role="tablist">
                                                                            <a class="nav-item nav-link active"
                                                                                id="nav-contact-tab" data-toggle="tab"
                                                                                href="#nav-contact2" role="tab"
                                                                                aria-controls="nav-contact"
                                                                                aria-selected="false">Tablo
                                                                                Grafik</a>
                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content" id="nav-tabContent">

                                                                        <div class="tab-pane fade show active"
                                                                            id="nav-contact2" role="tabpanel"
                                                                            aria-labelledby="nav-contact-tab">
                                                                            <div class="table-responsive ">
                                                                                <table id="tablo4"
                                                                                    class="table table-striped table-inverse table-responsive table-hover w-100 d-block d-md-table">
                                                                                    <thead class="thead-inverse">
                                                                                        <tr>
                                                                                            <th>Durum</th>
                                                                                            <th>Sayı</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        @foreach ($durumSayisi as
                                                                                        $durumKodu
                                                                                        => $sayi)

                                                                                        <tr>
                                                                                            <td scope="col">
                                                                                                @foreach ($durumlar as
                                                                                                $durum)
                                                                                                @if ($durum->id ===
                                                                                                $durumKodu)
                                                                                                {{ $durum->durum_aciklama  }}
                                                                                                @endif
                                                                                                @endforeach

                                                                                            </td>
                                                                                            <td scope="col text-left">
                                                                                                {{ $sayi }}</td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    </div>
    <script>
        $('#tablo1').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Sayfa Başına _MENU_ Kayıt Göster",
                "search": "Arama",
                "zeroRecords": "Kayıt Bulunamadı - Üzgünüz",
                "info": "Gösterilen Sayfa _PAGE_ of _PAGES_",
                "infoEmpty": "Hiç Kayıt Bulunamadı",
                "infoFiltered": "(_MAX_ kayıttan filtrelendi)"
            },
            "searching": false,
            "bPaginate": false
        });
        $('#tablo2').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Sayfa Başına _MENU_ Kayıt Göster",
                "search": "Arama",
                "zeroRecords": "Kayıt Bulunamadı - Üzgünüz",
                "info": "Gösterilen Sayfa _PAGE_ of _PAGES_",
                "infoEmpty": "Hiç Kayıt Bulunamadı",
                "infoFiltered": "(_MAX_ kayıttan filtrelendi)"
            },
            "searching": false,
            "bPaginate": false
        });
        $('#tablo3').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Sayfa Başına _MENU_ Kayıt Göster",
                "search": "Arama",
                "zeroRecords": "Kayıt Bulunamadı - Üzgünüz",
                "info": "Gösterilen Sayfa _PAGE_ of _PAGES_",
                "infoEmpty": "Hiç Kayıt Bulunamadı",
                "infoFiltered": "(_MAX_ kayıttan filtrelendi)"
            },
            "searching": false,
            "bPaginate": false
        });
        $('#tablo4').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Sayfa Başına _MENU_ Kayıt Göster",
                "search": "Arama",
                "zeroRecords": "Kayıt Bulunamadı - Üzgünüz",
                "info": "Gösterilen Sayfa _PAGE_ of _PAGES_",
                "infoEmpty": "Hiç Kayıt Bulunamadı",
                "infoFiltered": "(_MAX_ kayıttan filtrelendi)"
            },
            "searching": false,
            "bPaginate": false
        });
        var chartData;
        var labels2 = [];
        var data2 = []; //sehirler
        var data3 = []; //aylara göre
        var data4 = []; //sektöre göre
        var data5 = []; //duruma göre
        var sehirSayisi = [];
        var sehirler = [];
        var aylar = [];
        var ayData = [];
        $(document).ready(function () {
            var targetUrl = '/yonetim/charts';
            var sehirlerUrl = '/sehirler';
            $.ajax({
                url: sehirlerUrl,
                type: 'get',
                success: function (result) {
                    sehirler = result.sehirler;
                    console.log(aylar);
                },
                error: function (result) {
                    console.log(result.responseJSON.message);

                }
            });
            $.ajax({
                url: targetUrl,
                type: 'get',
                success: function (result) {
                    chartData = JSON.parse(result.sehirSayisi);
                    ayDataRaw = JSON.parse(result.aySayisi);
                    console.log(ayData, 'aySayisi');
                    $.each(chartData, function (k, v) {
                        var obj = {
                            sehir: k,
                            sayi: v
                        }
                        sehirSayisi.push(obj)
                    });
                    $.each(ayDataRaw, function (k, v) {
                        var obj = {
                            month: k,
                            sayi: v
                        }
                        ayData.push(obj)
                    });
                    ayData = ayData.sort(function (a, b) {
                        return parseFloat(b.sayi) - parseFloat(a.sayi);
                    });
                    sehirSayisi = sehirSayisi.sort(function (a, b) {
                        return parseFloat(b.sayi) - parseFloat(a.sayi);
                    });
                    aylar.push('Ocak');
                    aylar.push('Şubat');
                    aylar.push('Mart');
                    aylar.push('Nisan');
                    aylar.push('Mayıs');
                    aylar.push('Haziran');
                    aylar.push('Temmuz');
                    aylar.push('Ağustos');
                    aylar.push('Eylül');
                    aylar.push('Ekim');
                    aylar.push('Kasım');
                    aylar.push('Aralık');
                    for (let index = 0; index < 12; index++) {
                        data3.splice(index, 0, 0);
                    }
                    for (let index = 0; index < 12; index++) {

                        if (ayData[index] != null) {
                            data3.splice(ayData[index].month - 1, 1, ayData[index].sayi);
                            console.log(index, ayData[index]);
                        }

                    }
                    console.log(data3);

                    for (let index = 0; index < sehirSayisi.length; index++) {
                        if (sehirSayisi[index].sayi > 0) {
                            labels2.splice(index, 0, sehirSayisi[index].sehir)
                            data2.splice(index, 0, sehirSayisi[index].sayi)
                        }
                    }

                    var coloR = [];
                    var dynamicColors = function () {
                        var r = Math.floor(Math.random() * 200);
                        var g = Math.floor(Math.random() * 255);
                        var b = Math.floor(Math.random() * 170);
                        return "rgb(" + r + "," + g + "," + b + ")";
                    };
                    for (let index = 0; index < sehirSayisi.length; index++) {
                        coloR.push(dynamicColors());
                    }
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels2,
                            datasets: [{
                                label: 'Kayıt',
                                data: data2,
                                backgroundColor: coloR,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    var ctx2 = document.getElementById('myChart2').getContext('2d');
                    var myChart2 = new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: labels2,
                            datasets: [{
                                label: '# of Votes',
                                data: data2,
                                backgroundColor: coloR,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    var ctx21 = document.getElementById('myChart2-1').getContext('2d');
                    var myChart21 = new Chart(ctx21, {
                        type: 'bar',
                        data: {
                            labels: aylar,
                            datasets: [{
                                label: 'Kayıt',
                                data: data3,
                                backgroundColor: coloR,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    var ctx22 = document.getElementById('myChart2-2').getContext('2d');
                    var myChart22 = new Chart(ctx22, {
                        type: 'doughnut',
                        data: {
                            labels: aylar,
                            datasets: [{
                                label: '# of Votes',
                                data: data3,
                                backgroundColor: coloR,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                },
                error: function (result) {
                    console.log(result.responseJSON.message);

                }
            });


        });

    </script>
