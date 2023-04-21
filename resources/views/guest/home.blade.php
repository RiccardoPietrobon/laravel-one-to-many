@extends('layouts.guest')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            Progetti Pubblicati
        </h2>
        <div class="container row justify-content-around">
            @foreach ($good_projects as $good_project)
                <div class="card col-3" style="width: 18rem;">
                    <img src="{{$good_project->getImageUri()}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$good_project->title}}</h5>
                        <p class="card-text">{{$good_project->getAbstract(20)}}</p>
                        <a href="{{ route('guest.projects.show', $good_project) }}" class="btn btn-dark">Dettaglio</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection