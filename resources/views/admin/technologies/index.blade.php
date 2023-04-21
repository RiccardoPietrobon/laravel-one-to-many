@extends('layouts.app')

@section('title', 'TECNOLOGIE') {{-- titolo tecnologie --}}

@section('actions')
    <div>
        <a href="{{route('admin.technologies.create')}}" class="btn btn-dark">
            Nuova tecnologia
        </a>
    </div>
@endsection

@section('content')
    <section>
        <table class="table table-primary">
            <thead>
                <tr>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ID
                        @if ($sort == 'id')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=label&order={{ $sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        LABEL
                        @if ($sort == 'label')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=color&order={{ $sort == 'color' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        COLOR
                        @if ($sort == 'color')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=label&order={{ $sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        TECNOLOGIA
                        @if ($sort == 'label')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=updated_at&order={{ $sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ULTIMA MODIFICA
                        @if ($sort == 'updated_at')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.technologies.index') }}?sort=created_at&order={{ $sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
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
                @forelse ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td>{{ $technology->label }}</td>
                        <td><span class="badge" style="background-color: {{ $technology->color }}">{{ $technology->color }}</span></td>
                        <td>{!! $technology->getBadgeHTML() !!}</td>
                        <td>{{ $technology->updated_at }}</td>
                        <td>{{ $technology->created_at }}</td>

                        <td>
                            <a href="{{ route('admin.technologies.show', $technology) }}">
                                <i class="bi bi-box-arrow-right mx-1"></i>
                            </a>

                            <a href="{{ route('admin.technologies.edit', $technology) }}">
                                <i class="bi bi-pen-fill mx-1"></i>
                            </a>

                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-technology-modal-{{ $technology->id }}">
                                <i class="bi bi-trash mx-1"></i>
                            </a>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            Nessun risultato
                        </td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>

        {{ $technologies->links() }}
    </section>

@endsection

@section('modals')
    @foreach ($technologies as $technology)
        <div class="modal fade" id="delete-technology-modal-{{ $technology->id }}" tabindex="-1" aria-labelledby="delete-technology-modal-{{ $technology->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-technology-modal-{{ $technology->id }}-label">Elimina la tipologia n°{{ $technology->id }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La tipologia <strong>{{ $technology->label }}</strong> sarà eliminata. Sei sicuro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, annulla</button>
                    <form method="POST" action="{{ route('admin.technologies.destroy', $technology)}}">
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