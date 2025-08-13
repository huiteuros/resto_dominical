@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le restaurant</h1>

    <form action="{{ route('restaurants.update', $restaurant) }}" method="POST">
        @csrf
        @method('PUT')
        @include('restaurants.partials.form', ['restaurant' => $restaurant])
        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
