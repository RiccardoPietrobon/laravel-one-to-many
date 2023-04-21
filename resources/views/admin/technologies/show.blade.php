@extends('layouts.app')

@section('title', $technology->label)

@section('content')

    <section>
        <h5>Tipologia: <span class="badge" style="background-color: {{$technology->color}}">{{$technology->label}}</span></h5>
        <a href="{{route('admin.technologies.index')}}" class="btn btn-primary">Torna indietro</a>
        <a href="{{route('admin.technologies.edit', $technology)}}" class="btn btn-primary">Modifica</a>

    </section>

@endsection