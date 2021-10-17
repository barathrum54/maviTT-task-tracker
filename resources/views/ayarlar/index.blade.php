@include('layouts.app')


<div class="row pl-3 animated fadeIn mt-4">

    <div class="col-md-9">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                        <h4>Kategoriler</h4>
                    </div>
                    <div class="card-body">
                        @forelse ($tumkategoriler as $item)
                        <div>
                            <p>{{ $item->baslik }}</p>
                        </div>
                        @empty
                        <p>Hiç kategori yok</p>
                        @endforelse


                    </div>
                    <div class="card-footer">
                        <a href="/ayarlar/kategoriekle">

                            <button class="btn btn-primary">Kategori Ekle</button>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                        <h4>Diğer</h4>

                    </div>
                    <div class="card-body">
                        <a href="/ayarlar/kullanicilar">
                            <button class="btn btn-primary">Kullanıcıları Yönet</button>
                        </a>

                    </div>
                    <div class="card-footer">
                    </div>
                </div>

            </div>
        </div>
    </div>
