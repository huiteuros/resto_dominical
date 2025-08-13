@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Ajouter un restaurant</h1>

    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf
        @include('restaurants.partials.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
