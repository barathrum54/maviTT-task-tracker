@include('layouts.app')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <strong>
                        {{ $task->BASLIK }}
                    </strong>
                </div>

                <div class="card-body">

                    <p>{{ $task->ACIKLAMA }}</p>
                    <p>{{ $task->NOTLAR }}</p>
                </div>
                <div class="card-footer">
                    <div class="row">

                        <form action="/tasks/{{ $task->id }}" method="post">
                            @method('PATCH')

                            @if ($task->AKTIF == 1)
                            <button class="btn btn-primary shadow"
                                onclick="return confirm('Görevi tamamlamak istediğinize emin misiniz?')">Bitir</button>
                            @else
                            <p>Görev tamamlanma tarihi: {{ $task->updated_at }}</p>
                            @endif
                            @csrf

                        </form>
                        <form action="/tasks/iptal/{{ $task->id }}" method="post">
                            @method('PATCH')

                            @if ($task->AKTIF == 1 && $admin_mi == 1)
                            <button class="btn btn-danger ml-2 shadow"
                                onclick="return confirm('Görevi iptal etmek istediğinize emin misiniz?')">İptal</button>
                            @endif
                            @csrf

                        </form>
                    </div>

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
