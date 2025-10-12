<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LieuController extends Controller
{
    public function index()
    {
        $lieux = Lieu::with('type')->get();
        return view('lieux.index', compact('lieux'));
    }

    public function create()
    {
        $types = Type::all();
        return view('lieux.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'adresse' => 'nullable|string|max:255',
            'id_type' => 'required|exists:type,id_type',
        ]);

        Lieu::create($validated);

        return redirect()->route('lieux.index')->with('success', 'Lieu ajouté avec succès.');
    }

    public function show(Lieu $lieu)
    {
        $lieu->load(['type', 'avis.copain']);
        return view('lieux.show', compact('lieu'));
    }

    public function edit(Lieu $lieu)
    {
        $types = Type::all();
        return view('lieux.edit', compact('lieu', 'types'));
    }

    public function update(Request $request, Lieu $lieu): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'adresse' => 'nullable|string|max:255',
            'id_type' => 'required|exists:type,id_type',
        ]);

        $lieu->update($validated);

        return redirect()->route('lieux.index')->with('success', 'Lieu mis à jour avec succès.');
    }

    public function destroy(Lieu $lieu)
    {
        $lieu->delete();
        return redirect()->route('lieux.index')->with('success', 'Lieu supprimé avec succès.');
    }

    public function storeType(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
        ]);

        $type = Type::create($validated);

        return response()->json([
            'success' => true,
            'type' => $type
        ]);
    }
}
