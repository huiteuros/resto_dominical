<?php

namespace App\Http\Controllers;

use App\Services\StatsService;

class StatsController extends Controller
{
    public function index()
    {
        return view('stats.index', [
            'meilleurTaux' => StatsService::meilleurTauxParticipation(),
            'meilleurStreak' => StatsService::meilleurStreak(),
            'meilleurQualite' => StatsService::meilleurRestoQualite(),
            'meilleurQualitePrix' => StatsService::meilleurRestoQualitePrix(),
            'meilleurOverall' => StatsService::meilleurRestoOverall(),
            'meilleurNoteGenerale' => StatsService::meilleurRestoNoteGenerale()
        ]);
    }
}
