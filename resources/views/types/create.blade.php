@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Ajouter un type</h1>

    <form action="{{ route('types.store') }}" method="POST">
        @csrf
        @include('types.partials.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('types.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
