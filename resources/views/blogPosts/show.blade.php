@include('layouts.app')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <strong>
                        {{ $post->title }}
                    </strong>
                </div>

                <div class="card-body">

                    <p>{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <p>{{ $post->author }}</p>
                    <p>Oluşturma tarihi: {{ $post->updated_at }}</p>
                    <form action="/blog/{{ $post->id }}" method="post">


                        {{-- blog postu silme yap --}}
                        @method('DELETE')
                        <button>Sil</button>
                        @csrf
                    </form>
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
