<h1>Görev Detay Düzenle</h1>

<form action="/tasks/{{ $task->id }}" method="post">

    @method('PATCH')

@include('tasks.form')
        <button type="submit">Kaydet</button>
</form>