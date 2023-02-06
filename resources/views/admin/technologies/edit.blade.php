@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Modifica: {{ $technology->name }}</h1>
    
    <div class="mt-4">
        <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input technology="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" value="{{ old('name', $technology->name) }}">
            </div>
            <button technology="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
  </div>
</div>
@endsection