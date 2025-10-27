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
            <tbody id="table-participation">
                @foreach($meilleurTaux as $index => $copain)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $copain->pseudo ?? $copain->prenom . ' ' . $copain->nom }}</td>
                    <td>{{ $copain->participations_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurTaux) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-participation">Voir plus</button>
        </div>
        @endif
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
            <tbody id="table-streak">
                @foreach($meilleurStreak as $index => $streak)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $streak['copain'] }}</td>
                    <td>{{ $streak['max_streak'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurStreak) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-streak">Voir plus</button>
        </div>
        @endif
    </section>

    <section class="mb-5">
        <h2 class="h2">Streak en cours</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Copain</th>
                    <th>Série actuelle</th>
                </tr>
            </thead>
            <tbody id="table-streak-cours">
                @foreach($streakEnCours as $index => $streak)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $streak['copain'] }}</td>
                    <td>{{ $streak['current_streak'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($streakEnCours) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-streak-cours">Voir plus</button>
        </div>
        @endif
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
            <tbody id="table-qualite">
                @foreach($meilleurQualite as $index => $resto)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_qualite, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurQualite) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-qualite">Voir plus</button>
        </div>
        @endif
    </section>

    <section class="mb-5">
        <h2 class="h2">Meilleur restaurant rapport qualité/prix</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Restaurant</th>
                    <th>Moyenne prix</th>
                </tr>
            </thead>
            <tbody id="table-prix">
                @foreach($meilleurQualitePrix as $index => $resto)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_prix, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurQualitePrix) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-prix">Voir plus</button>
        </div>
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
            <tbody id="table-overall">
                @foreach($meilleurOverall as $index => $resto)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_overall, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurOverall) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-overall">Voir plus</button>
        </div>
        @endif
    </section>

    <section class="mb-5">
        <h2 class="h2">Meilleur restaurant toutes notes confondues</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Restaurant</th>
                    <th>Moyenne /20</th>
                    <th>Nombre d'avis</th>
                </tr>
            </thead>
            <tbody id="table-generale">
                @foreach($meilleurNoteGenerale as $index => $resto)
                <tr class="{{ $index >= 3 ? 'hidden-row' : '' }}" style="{{ $index >= 3 ? 'display: none;' : '' }}">
                    <td>{{ $resto->nom_restau }}</td>
                    <td>{{ number_format($resto->moyenne_generale, 2) }}</td>
                    <td>{{ $resto->nb_avis }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($meilleurNoteGenerale) > 3)
        <div class="text-center">
            <button class="btn btn-primary btn-sm toggle-btn" data-target="table-generale">Voir plus</button>
        </div>
        @endif
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const tbody = document.getElementById(targetId);
            const hiddenRows = tbody.querySelectorAll('.hidden-row');
            
            hiddenRows.forEach(row => {
                if (row.style.display === 'none') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Changer le texte du bouton
            if (this.textContent === 'Voir plus') {
                this.textContent = 'Voir moins';
            } else {
                this.textContent = 'Voir plus';
            }
        });
    });
});
</script>
@endsection
