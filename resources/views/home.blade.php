@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Ana Sayfa</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1>
                        {{ ucfirst(trans( $user->name )) }}
                    </h1>
                    <hr>
                    <div>
                        <h3>Bitirilmiş Görevler</h3>
                    </div>
                    <div>
                        @forelse ($bitirilmisGorevler as $bg)
                        <p>{{ $bg }}</p>
                        @empty
                        <p>
                            Bitirilmiş göreviniz yok.
                        </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
