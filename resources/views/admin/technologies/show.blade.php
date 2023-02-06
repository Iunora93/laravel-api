@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>{{$technology->name}}</h1>
    @if($technology->projects->isNotEmpty())
        <h3>project associati:</h3>
        <ul>
            @foreach ($technology->projects as $project)
                <li><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
            @endforeach
        </ul>
    @else
        <h3>Nessun project associato</h3>
    @endif
  </div>
</div>
@endsection