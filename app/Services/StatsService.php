<?php

namespace App\Services;

use App\Models\Copain;
use App\Models\Restaurant;

class StatsService
{
    /**
     * Meilleur taux de participation (classement complet)
     */
    public static function meilleurTauxParticipation()
    {
        return Copain::withCount('participations')
            ->orderByDesc('participations_count')
            ->get();
    }

    public static function meilleurStreak()
    {
        $streaks = [];

        foreach (Copain::with([
            'participations' => function ($query) {
                $query->whereHas('restopasse', function ($q) {
                    $q->where('numero_dimanche', '>=', 0);
                })->with([
                            'restopasse' => function ($q) {
                                $q->where('numero_dimanche', '>=', 0);
                            }
                        ]);
            }
        ])
            ->orderBy('id_copain')
            ->get() as $copain) {

            $nums = $copain->participations->pluck('restopasse.numero_dimanche')->toArray();

            $currentStreak = $maxStreak = 0;
            $previousNum = null;

            foreach ($nums as $num) {
                if ($previousNum === null || $num === $previousNum + 1) {
                    // Numéro dimanche consécutif → on continue le streak
                    $currentStreak++;
                } else {
                    // Pas consécutif → reset streak
                    $currentStreak = 1;
                }
                $maxStreak = max($maxStreak, $currentStreak);
                $previousNum = $num;
            }

            $streaks[] = [
                'copain' => $copain->pseudo ?? "{$copain->prenom} {$copain->nom}",
                'max_streak' => $maxStreak
            ];
        }

        usort($streaks, fn($a, $b) => $b['max_streak'] <=> $a['max_streak']);

        return $streaks;
    }


    /**
     * Classement restos par qualité nourriture
     */
    public static function meilleurRestoQualite()
    {
        return Restaurant::select('restaurant.*')
            ->selectRaw('AVG(amange.qualite_nourriture) as moyenne_qualite')
            ->join('restopasse', 'restaurant.id_restaurant', '=', 'restopasse.id_restaurant')
            ->join('amange', 'restopasse.id_restopasse', '=', 'amange.id_restopasse')
            ->groupBy('restaurant.id_restaurant')
            ->orderByDesc('moyenne_qualite')
            ->get();
    }

    /**
     * Resto le plus cher
     */
    public static function restoLePlusCher()
    {
        return Restaurant::select('restaurant.*')
            ->selectRaw('AVG(amange.prix) as moyenne_prix')
            ->join('restopasse', 'restaurant.id_restaurant', '=', 'restopasse.id_restaurant')
            ->join('amange', 'restopasse.id_restopasse', '=', 'amange.id_restopasse')
            ->groupBy('restaurant.id_restaurant')
            ->orderByDesc('moyenne_prix')
            ->first();
    }

    /**
     * Classement restos par note globale
     */
    public static function meilleurRestoOverall()
    {
        return Restaurant::select('restaurant.*')
            ->selectRaw('AVG(amange.overall) as moyenne_overall')
            ->join('restopasse', 'restaurant.id_restaurant', '=', 'restopasse.id_restaurant')
            ->join('amange', 'restopasse.id_restopasse', '=', 'amange.id_restopasse')
            ->groupBy('restaurant.id_restaurant')
            ->orderByDesc('moyenne_overall')
            ->get();
    }
}
