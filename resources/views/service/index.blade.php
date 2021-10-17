@extends('app')

@section('title', 'Services')
       
@section('content')
<h1>Services</h1>

<form action="/services" method="post">
  <input autocomplete="off" type="text" name="name">

  <button>Add Service</button>
  @csrf

</form>
@error('name')İsim alanı gereklidir  @enderror
<ul>
  @forelse ($services as $service)

        <li>{{ $service->name }}</li>
        
        @empty
            <li>Servis yok</li>
      
  @endforelse


</ul>
@endsection