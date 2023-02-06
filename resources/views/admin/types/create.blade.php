@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Crea una nuova Categoria</h1>
    <div class="mt-4">
        <form action="{{ route('admin.types.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" value="{{ old('name') }}">
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
  </div>
</div>
@endsection