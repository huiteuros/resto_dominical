@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Statistiques</h1>

    <section class="mb-5">
        <h2 class="h2">Meilleur taux de participation</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Copain</th>
                    <th>Nombre de participations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meilleurTaux as $copain)
                <tr>
                    <td>{{ $copain->pseudo ?? $copain->prenom . ' ' . $copain->nom }}</td>
                    <td>{{ $copain->participations_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="mb-5">
        <h2 class="h2">Meilleur streak</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Copain</th>
                    <th>Streak maximum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meilleurStreak as $streak)
                <tr>
                    <td>{{ $streak['copain'] }}</td>
                    <td>{{ $streak['max_streak'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="mb-5">
        <h2 class="h2">Meilleur restaurant par qualité de la nourriture</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Restaurant</th>
                    <th>Moyenne qualité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meilleurQualite as $resto)
                <tr>
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_qualite, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="mb-5">
        <h2 class="h2">Restaurant le plus cher (prix moyen)</h2>
        @if($restoCher)
            <p><strong>{{ $restoCher->nom_restau }}</strong> avec un prix moyen à {{ number_format($restoCher->moyenne_prix, 2) }} /5</p>
        @else
            <p>Aucun restaurant trouvé.</p>
        @endif
    </section>

    <section class="mb-5">
        <h2 class="h2">Meilleur restaurant note globale</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Restaurant</th>
                    <th>Moyenne note globale</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meilleurOverall as $resto)
                <tr>
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_overall, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
