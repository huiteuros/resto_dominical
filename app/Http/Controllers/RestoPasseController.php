<?php

namespace App\Http\Controllers;

use App\Models\RestoPasse;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestoPasseController extends Controller
{
    public function index()
    {
        $restopasses = RestoPasse::with('restaurant')->get();
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
            'numero_dimanche' => 'nullable|integer',
            'date_sortie' => 'required|date',
        ]);

        RestoPasse::create($validated);

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant créée avec succès !');
    }

    public function show(RestoPasse $restopasse)
    {
        return view('restopasse.show', compact('restopasse'));
    }

    public function edit(RestoPasse $restopasse)
    {
        $restaurants = Restaurant::all();
        return view('restopasse.edit', compact('restopasse', 'restaurants'));
    }

    public function update(Request $request, RestoPasse $restopasse)
    {
        $validated = $request->validate([
            'id_restaurant' => 'required|exists:restaurant,id_restaurant',
            'numero_dimanche' => 'nullable|integer',
            'date_sortie' => 'required|date',
        ]);

        $restopasse->update($validated);

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant modifiée avec succès !');
    }

    public function destroy(RestoPasse $restopasse)
    {
        $restopasse->delete();

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant supprimée avec succès !');
    }
}
