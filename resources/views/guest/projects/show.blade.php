@extends('layouts.guest')

@section('title', 'mario')


@section('content')

    <div class="container mt-5">
        <img src="{{ $project->getImageUri() }}" alt="" width="400" class="my-3">
        <h5 class="text-white">Tipologia: @if ($project->type) {!! $project->type->getBadgeHTML() !!} @else Nessuna @endif </h5>     
        
        <h5 class="text-white">Tecnologia: @forelse($project->technologies as $technology) {!! $technology->getBadgeHTML() !!}
                        @empty
                        Nessuna
                        @endforelse
        </h5>

        <p class="text-white">
            <strong>Descrizione</strong>
            <br>
            {{$project->text}}
        </p>
    </div>

@endsection