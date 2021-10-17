@include('layouts.app')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Yeni Blog Girdisi</div>

                <div class="card-body">
                    <form action="/blog/postEkle" method="post">
                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input autocomplete="off" type="text" name="title" id="title" class="form-control"
                                placeholder="Başlık Giriniz" aria-describedby="helpId">
                            @error('title')
                            <small style="color:red">Lütfen başlık giriniz.</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="content">İçerik</label>
                            <textarea type="text" name="content" id="content" class="form-control"
                                placeholder="İçerik giriniz" aria-describedby="helpId"></textarea>
                            @error('content')
                            <small style="color:red">Lütfen içerik giriniz.</small>
                            @enderror
                        </div>
                        <br>
                        <button class="btn btn-primary">Ekle</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
