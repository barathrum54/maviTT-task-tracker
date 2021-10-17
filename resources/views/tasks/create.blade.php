@include('layouts.app')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Yeni Görev</div>

                <div class="card-body">
                    <form id=route action="/tasks" onselect="test()" method="post">
                        @include('tasks.form')
                        <br>
                        <button class="btn btn-primary">Ekle</button>
                    </form>
                </div>

                <script>


                </script>
            </div>
        </div>
    </div>
</div>
