@extends('layouts.app')

@section('title', 'LISTA')

@section('actions')
    <div>
        <a href="{{route('admin.projects.create')}}" class="btn btn-dark">
            Nuovo Progetto
        </a>
    </div>
@endsection

@section('content')
    <section>
        <table class="table table-primary">
            <thead>
                <tr>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ID
                        @if ($sort == 'id')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=title&order={{ $sort == 'title' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        TITOLO
                        @if ($sort == 'title')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=title&order={{ $sort == 'title' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        TIPO
                        @if ($sort == 'title')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    TECNOLOGIE
                </th>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=text&order={{ $sort == 'text' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ABSTRACT
                        @if ($sort == 'text')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=updated_at&order={{ $sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ULTIMA MODIFICA
                        @if ($sort == 'updated_at')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.projects.index') }}?sort=created_at&order={{ $sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        CREAZIONE
                        @if ($sort == 'created_at')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>

                <th scope="col">AZIONI</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{!! $project->type?->getBadgeHTML() !!}</td>
                    <td>
                        @forelse($project->technologies as $technology) {!! $technology->getBadgeHTML() !!}
                        @empty
                         - 
                        @endforelse
                    </td>
                    <td>{{ $project->getAbstract(20) }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td>{{ $project->created_at }}</td>

                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}">
                            <i class="bi bi-box-arrow-right mx-1"></i>
                        </a>

                        <a href="{{ route('admin.projects.edit', $project) }}">
                            <i class="bi bi-pen-fill mx-1"></i>
                        </a>

                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-project-modal-{{ $project->id }}">
                            <i class="bi bi-trash mx-1"></i>
                        </a>
                        
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            Nessun risultato
                        </td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>

        {{ $projects->links() }}
    </section>

@endsection

@section('modals')
    @foreach ($projects as $project)
        <div class="modal fade" id="delete-project-modal-{{ $project->id }}" tabindex="-1" aria-labelledby="delete-project-modal-{{ $project->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-project-modal-{{ $project->id }}-label">Elimina il progetto n°{{ $project->id }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Il progetto <strong>{{ $project->title }}</strong> sarà eliminato. Sei sicuro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, annulla</button>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project)}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-primary">Sì, elimina</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection