<?php

namespace App\Http\Controllers;

use App\Models\Restopasse;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestoPasseController extends Controller
{
    public function index()
    {
        $restopasses = Restopasse::with('restaurant')->orderBy('date_sortie','desc')
        ->get();
        return view('restopasse.index', compact('restopasses'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('restopasse.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_restaurant' => 'required|exists:restaurant,id_restaurant',
            'serie_dimanche' => 'required|boolean',
            'date_sortie' => 'required|date',
        ]);

        // Déterminer le numéro de dimanche
        if ($validated['serie_dimanche']) {
            // Récupérer le plus haut numéro de dimanche et ajouter 1
            $maxNumero = Restopasse::max('numero_dimanche');
            $validated['numero_dimanche'] = ($maxNumero !== null && $maxNumero >= 0) ? $maxNumero + 1 : 1;
        } else {
            // Hors série
            $validated['numero_dimanche'] = -1;
        }

        // Retirer serie_dimanche des données à sauvegarder
        unset($validated['serie_dimanche']);

        Restopasse::create($validated);

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant créée avec succès !');
    }

    public function show(Restopasse $restopasse)
    {
        return view('restopasse.show', compact('restopasse'));
    }

    public function edit(Restopasse $restopasse)
    {
        $restaurants = Restaurant::all();
        return view('restopasse.edit', compact('restopasse', 'restaurants'));
    }

    public function update(Request $request, Restopasse $restopasse)
    {
        $validated = $request->validate([
            'id_restaurant' => 'required|exists:restaurant,id_restaurant',
            'serie_dimanche' => 'required|boolean',
            'date_sortie' => 'required|date',
        ]);

        // Déterminer le numéro de dimanche
        if ($validated['serie_dimanche']) {
            // Si c'était déjà une série, garder le même numéro
            if ($restopasse->numero_dimanche >= 0) {
                $validated['numero_dimanche'] = $restopasse->numero_dimanche;
            } else {
                // Sinon, récupérer le plus haut numéro de dimanche et ajouter 1
                $maxNumero = Restopasse::max('numero_dimanche');
                $validated['numero_dimanche'] = ($maxNumero !== null && $maxNumero >= 0) ? $maxNumero + 1 : 1;
            }
        } else {
            // Hors série
            $validated['numero_dimanche'] = -1;
        }

        // Retirer serie_dimanche des données à sauvegarder
        unset($validated['serie_dimanche']);

        $restopasse->update($validated);

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant modifiée avec succès !');
    }

    public function destroy(Restopasse $restopasse)
    {
        $restopasse->delete();

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant supprimée avec succès !');
    }
}
