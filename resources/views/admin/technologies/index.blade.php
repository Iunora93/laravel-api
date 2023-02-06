@extends('layouts.admin')

@section('content')
    <h1>Lista Tecnologie</h1>
    <div class="my-4 ">
      <a href="{{route('admin.technologies.create')}}" class="btn btn-primary " >Crea</a>
    </div>
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message')}}
    </div>
@endif
    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Dettagli</th>
            <th scope="col">Modifica</th>
            <th scope="col">Cancella</th>


          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>{{ $technology->id }}</td>
                <td>{{ $technology->title }}</td>
                <td>{{ $technology->slug }}</td>
                <td><a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-success">Dettaglio</a></td>
                <td><a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning">Modifica</a></td>
                <td>                  
                  <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" >Cancella</button>
                  </form>
                </td>
                  
            </tr>
            @endforeach
        </tbody>
      </table>
      
@endsection