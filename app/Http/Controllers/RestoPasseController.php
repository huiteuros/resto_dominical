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
            'numero_dimanche' => 'nullable|integer',
            'date_sortie' => 'required|date',
        ]);

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
            'numero_dimanche' => 'nullable|integer',
            'date_sortie' => 'required|date',
        ]);

        $restopasse->update($validated);

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant modifiée avec succès !');
    }

    public function destroy(Restopasse $restopasse)
    {
        $restopasse->delete();

        return redirect()->route('restopasse.index')->with('success', 'Sortie restaurant supprimée avec succès !');
    }
}
