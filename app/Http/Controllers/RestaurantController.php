<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use View;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_restau' => 'required|string|max:255',
            'type_restau' => 'required|string|max:100',
            'adresse_postale' => 'nullable|string|max:255',
            'lien_site_web' => 'nullable|url|max:255',
            'ouvert_dimanche_midi' => 'boolean',
        ]);

        Restaurant::create($validated);

        return redirect()->route('restaurants.index')->with('success', 'Restaurant ajouté avec succès.');
    }

    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant): RedirectResponse
    {
        $validated = $request->validate([
            'nom_restau' => 'required|string|max:255',
            'type_restau' => 'required|string|max:100',
            'adresse_postale' => 'nullable|string|max:255',
            'lien_site_web' => 'nullable|url|max:255',
            'ouvert_dimanche_midi' => 'boolean',
        ]);

        $restaurant->update($validated);

        return redirect()->route('restaurants.index')->with('success', 'Restaurant mis à jour avec succès.');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Restaurant supprimé avec succès.');
    }

    public function avis(Restaurant $restaurant){
        $data = ($restaurant->getAvis());
        $resto = $restaurant->nom_restau;

        return view('restaurants.avis', compact('data', 'resto'));
    }
}
