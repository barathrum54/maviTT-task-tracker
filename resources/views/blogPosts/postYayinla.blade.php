@include('layouts.app')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row p-3 d-flex justify-content-between">
                        <h2>Blog Postları</h2>
                        <div class="float-right">
                            <a href="/blog/postEkle">
                                <button class="btn btn-primary">Post Ekle</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($blogPosts as $bp)
                    <div class="card text-left">
                        <div class="card-body">
                            <h4 class="card-title">{{ $bp->title }}</h4>
                            <p class="card-text">{{ $bp->content }}</p>
                        </div>
                        <div class="card-footer">{{ $bp->author }}</div>
                    </div>
                    @empty
                    <p>Hiç Görev Yok</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
