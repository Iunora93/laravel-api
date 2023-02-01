@extends('layouts.admin')

@section('content')
<div class="container">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="py-4">
    <h1>Modifica {{$project->title}}</h1>
    
    <div class="mt-4">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <select class="form-select" name="types_id" id="types_id">
                <option value="">Nessun tipo</option>
                 @foreach ($types as $type)
                    <option value="{{$type->id}}" {{old('types_id', $project->types?->id) == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                 @endforeach
                
                
            </select>
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" value="{{ old('title', $project->title) }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Inserisci il contenuto">{{ old('content', $project->content) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Modifica immagine</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image">
            </div>
            <div class="mb-3">
                <div class="mb-2">Technologies</div>
                @foreach ($technologies as $technology)
                    @if($errors->any())
                        <input type="checkbox" class="form-check-label" name="technologies[]" id="{{$technology->slug}} {{ in_array( $technology->id, old('technologies', [])) ? 'checked' : '' }}" value="{{$technology->id}}">
                    @else
                        <input type="checkbox" class="form-check-label" name="technologies[]" id="{{$technology->slug}}" {{ $project->technologies->contains($technology->id) ? 'checked' : '' }} value="{{$technology->id}}">
                    @endif 
                    <label for="{{$technology->slug}}" class="form-check-label me-3">{{$technology->name}}</label>
                @endforeach
                @error('technologies[]')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
         </div>
        
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
  </div>
</div>
@endsection 