@extends('layouts.app')

@section('title', ($technology->id) ? 'Modifica la tecnologia' . $technology->label: 'Crea una nuova tecnologia'){{-- se ha un id è da modificare altrimenti è nuova --}}

@section('actions')
    <div>
        <a href="{{route('admin.technologies.index')}}" class="btn btn-dark m-1">
            Torna indietro
        </a>
        @if ($technology->id)
            <a href="{{route('admin.technologies.show', $technology)}}" class="btn btn-dark m-1">
            Mostrami il progetto
            </a>
        @endif
        
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

    <section class="card my-1">
        <div class="card-body">

            @if ($technology->id) {{-- se il progetto ha un id, quindi esiste già --}}
                <form action="{{route('admin.technologies.update', $technology)}}" method="post" enctype="multipart/form-data" class="row"> {{-- il form sarà per modificare --}}
                @method('put')
            @else
                <form action="{{route('admin.technologies.store')}}" method="post" enctype="multipart/form-data" class="row"> {{-- altrimenti sarà per crearne uno di nuovo --}}
            @endif
            
            @csrf
                <div class="row my-2 justify-content-center">
                    <div class="col-8">
                        <label for="label" class="form-label">LABEL</label>
                        <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @enderror" placeholder="Inserisci il nuovo label, massimo 20 caratteri" value="{{old('label', $technology->label)}}"/>
                        @error('label')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="row my-2 justify-content-center">
                    <div class="col-8">
                        <label for="color" class="form-label">COLOR</label>
                        <input type="color" name="color" id="color" class="form-control @error('color') is-invalid @enderror" placeholder="Inserisci il nuovo colore, es. #ffffff" value="{{old('color', $technology->color)}}"/>
                        @error('color')    
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row my-2 justify-content-end">
                    <div class="col-3">
                        <input type="submit" class="btn btn-primary my-2" value="Salva" id="image-preview">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection