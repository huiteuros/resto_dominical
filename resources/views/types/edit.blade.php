@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Modifier le type</h1>

    <form action="{{ route('types.update', $type) }}" method="POST">
        @csrf
        @method('PUT')
        @include('types.partials.form')
        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('types.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
