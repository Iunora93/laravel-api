@extends('layouts.admin')

@section('content')
    <h1>Lista Progetti</h1>
    <div class="my-4 ">
      <a href="{{route('admin.projects.create')}}" class="btn btn-primary " >Crea</a>
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
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->slug }}</td>
                <td><a href="{{ route('admin.projects.show', $project) }}" class="btn btn-success">Dettaglio</a></td>
                <td><a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Modifica</a></td>
                <td>                  
                  <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
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