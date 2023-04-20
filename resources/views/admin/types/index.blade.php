@extends('layouts.app')

@section('title', 'TIPOLOGIE') {{-- titolo tipologie --}}

@section('actions')
    <div>
        <a href="{{route('admin.types.create')}}" class="btn btn-dark">
            Nuova tipologia
        </a>
    </div>
@endsection

@section('content')
    <section>
        <table class="table table-primary">
            <thead>
                <tr>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ID
                        @if ($sort == 'id')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=label&order={{ $sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        LABEL
                        @if ($sort == 'label')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=color&order={{ $sort == 'color' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        COLOR
                        @if ($sort == 'color')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=label&order={{ $sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        TIPOLOGIA
                        @if ($sort == 'label')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=updated_at&order={{ $sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
                        ULTIMA MODIFICA
                        @if ($sort == 'updated_at')
                            <i class="bi bi-triangle-fill d-inline-block @if($order == 'DESC') rotate-180 @endif"></i>
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ route('admin.types.index') }}?sort=created_at&order={{ $sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
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
                @forelse ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->label }}</td>
                        <td><span class="badge" style="background-color: {{ $type->color }}">{{ $type->color }}</span></td>
                        <td>{!! $type->getBadgeHTML() !!}</td>
                        <td>{{ $type->updated_at }}</td>
                        <td>{{ $type->created_at }}</td>

                        <td>
                            <a href="{{ route('admin.types.show', $type) }}">
                                <i class="bi bi-box-arrow-right mx-1"></i>
                            </a>

                            <a href="{{ route('admin.types.edit', $type) }}">
                                <i class="bi bi-pen-fill mx-1"></i>
                            </a>

                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-type-modal-{{ $type->id }}">
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

        {{ $types->links() }}
    </section>

@endsection

@section('modals')
    @foreach ($types as $type)
        <div class="modal fade" id="delete-type-modal-{{ $type->id }}" tabindex="-1" aria-labelledby="delete-type-modal-{{ $type->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-type-modal-{{ $type->id }}-label">Elimina la tipologia n°{{ $type->id }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La tipologia <strong>{{ $type->label }}</strong> sarà eliminata. Sei sicuro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, annulla</button>
                    <form method="POST" action="{{ route('admin.types.destroy', $type)}}">
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