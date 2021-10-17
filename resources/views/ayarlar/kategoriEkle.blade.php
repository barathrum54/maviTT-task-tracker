@include('layouts.app')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Yeni Kategori</div>

              <div class="card-body">
                <form action="/ayarlar" method="post">
                    <div class="form-group">
                        <label for="kategoribaslik">Kategori Başlık</label>
                        <input type="text" class="form-control" name="baslik" id="kategoribaslik"  autocomplete="off" placeholder="Kategori için başlık giriniz."></textarea>
                        @error('kategoribaslik')
                         <small style="color:red !important" id="gorevSmall" class="form-text text-muted"> Lütfen başlık giriniz.</small>
                        @enderror
                      </div>
                      <button class="btn btn-primary">Ekle</button>
                      @csrf
                </form>
            </div>
          </div>
      </div>
  </div>
</div>
