@extends('layouts.app')

@section('title', $type->label)


@section('content')

    

    <section>
        <h5>Tipologia: <span class="badge" style="background-color: {{$type->color}}">{{$type->label}}</span></h5>
        <a href="{{route('admin.types.index')}}" class="btn btn-primary">Torna indietro</a>
        <a href="{{route('admin.types.edit', $type)}}" class="btn btn-primary">Modifica</a>

    </section>

@endsection