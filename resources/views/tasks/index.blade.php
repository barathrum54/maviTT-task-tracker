@include('layouts.app')


<div class="container animated fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    @if ($admin_mi == 1)

                    <div class="row justify-content-start ">

                        <div type="button" class="btn btn-light border m-1">
                            <a href="/tasks?AKTIF=1">Aktif Görevler</a>
                        </div>
                        <div type="button" class="btn btn-light border m-1">
                            <a href="/tasks?AKTIF=0">Tamamlanmış Görevler</a>
                        </div>
                        <div type="button" class="btn btn-light border m-1">
                            <a href="/tasks?AKTIF=2">İptal Edilmiş Görevler</a>
                        </div>
                        @if ($admin_mi == 1)
                        <div type="button" class="btn btn-primary border m-1">
                            <a href="/tasks/create" style="color:white">Yeni Görev Ekle</a>
                        </div>
                        @else

                        @endif
                        @else
                        <h4>Görevler</h4>
                        @endif

                    </div>
                    <br>
                    <div class="row justify-content-start">
                        {{ $tasks->appends(request()->query())->links()  }}
                    </div>

                </div>
                <style>
                    .tamamlandi {
                        position: absolute;
                        margin-top: -40px;
                        right: -10px;
                    }

                </style>
                <div class="card-body p-0 m-2 shadow" style="background-color:rgba(0,0,0,0)">
                    @forelse ($tasks as $task)

                    <div class="mb-4 pl-3 pr-3 pt-3 border-primary shadow "
                        style="border:1pt solid;border-radius:10px ">

                        <div class="row align-middle">

                            @if ($task->AKTIF == 0 && $task->SURESI_ASILMIS != 1)
                            <div class="tamamlandi">
                                <i class="fa fa-check mt-1 text-success" style="font-size:40pt" aria-hidden="true"></i>
                            </div>
                            @endif
                            @if ($task->AKTIF == 2)
                            <div class="tamamlandi">
                                <i class="fa fa-times mt-1 text-danger" style="font-size:40pt" aria-hidden="true"></i>
                            </div>
                            @endif
                            @if ($task->SURESI_ASILMIS == 1)
                            <div class="tamamlandi">
                                <i class="fa fa-clock-o text-danger" style="font-size:40pt" aria-hidden="true"></i>
                            </div>
                            @endif
                            <div class="col-sm-9 align-middle">

                                <p class="align-middle">

                                    <a href="/tasks/{{ $task->id }}"> {{ $task->BASLIK }}</a>
                                    <br>
                                    <small class="text-muted">
                                        {{ $task->BASLIK }}
                                    </small>
                                </p>
                                <hr>
                                <p class="align-middle">
                                    {{ $task->ACIKLAMA }}
                                </p>
                            </div>
                            <div class="col text-right" style="border-left:0.5pt dashed rgba(0,0,0,0.2)">
                                <div class="row">


                                    <div class="col-md-10 text-right">

                                        <small> Oluşturma Tarihi </small>
                                        <br>
                                        {{ date_format($task->created_at, 'H:i') }}
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <br>
                                        <strong>

                                            {{ date_format($task->created_at, 'd.m.Y') }}
                                            <i class="fa fa-calendar" aria-hidden="true"></i>

                                        </strong>
                                        @if ($task->AKTIF == 0)
                                        <hr>
                                        <small style="color:green"> Bitirme Tarihi </small>
                                        <br>
                                        {{ date_format($task->updated_at, 'H:i') }}
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <br>
                                        <strong>
                                            {{ date_format($task->updated_at, 'd.m.Y') }}
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </strong>
                                        @endif

                                    </div>

                                    <style>
                                        .fa {
                                            opacity: .8 !important;
                                            color: black;
                                            font-size: 14pt
                                        }

                                    </style>


                                </div>



                            </div>
                        </div>
                        <div class="row border-top" style="background-color:rgba(0,0,0,0.05)">
                            <div class="col-sm-6 align-middle">
                                <p class="align-middle d-flex flex-column">
                                    @foreach($users->where('id', $task->atanan_id) as $user)
                                    <small class="bg-success mt-2 mb-1 p-1 rounded shadow" style="width:50%">
                                        <small class="text-light">
                                            Atanan:
                                        </small>
                                        <span>
                                            <a class="text-light" href="ayarlar/kullanicilar/{{ $user->id }}">
                                                {{ $user->name }}
                                            </a>
                                        </span>
                                    </small>
                                    @endforeach
                                    @foreach($users->where('id', $task->atayan_id) as $user)
                                    <small class="bg-primary text-light p-1 rounded shadow" style="width:50%">
                                        <small>
                                            Atayan:
                                        </small>
                                        <span class="text-info">
                                            <a class="text-light" href="ayarlar/kullanicilar/{{ $user->id }}">
                                                {{ $user->name }}
                                            </a>
                                        </span>
                                    </small>
                                    @endforeach
                                </p>

                            </div>
                            <div class="col-sm-6 text-right">

                                @if ($task->hedefSure != null)
                                @if($task->hedefSure < now() && $task->AKTIF == 1) <i
                                        class="pt-2 fa fa-exclamation-triangle"
                                        style="color:red;font-size:15pt;opacity:0.5 !important" aria-hidden="true">



                                    </i> <span style="color:red;text-decoration:underline">
                                        <strong>Süresi
                                            Geçmiş</strong></span> &nbsp&nbsp
                                    @endif
                                    <small style="color:red">
                                        Termin zamanı:
                                    </small>
                                    <span>

                                        <strong>{{ date('H:i', strtotime($task->hedefSure)) }} </strong>|
                                        <small> {{ date('d.m.Y', strtotime($task->hedefSure)) }}</small>
                                    </span>

                                    @else

                                    @endif
                                    <br>
                                    @if($task->AKTIF==2)
                                    <small style="color:red">İptal Zamanı:</small>
                                    <span class="bg-danger text-light">

                                        <strong>{{ date('H:i', strtotime($task->updated_at)) }} </strong>|
                                        <small> {{ date('d.m.Y', strtotime($task->updated_at)) }}</small>
                                    </span>
                                    @endif
                            </div>

                        </div>
                    </div>

                    @empty
                    <h2 class="p-4 text-muted">Hiç Görev Yok</h2>
                    @endforelse


                </div>
            </div>

        </div>
    </div>
</div>
