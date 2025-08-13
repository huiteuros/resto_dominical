@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier une sortie restaurant</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('restopasse.partials.form', ['restopasse' => $restopasse])
</div>
@endsection
