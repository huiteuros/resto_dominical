<?php

namespace App\Http\Controllers;

use App\Models\Amange;
use App\Models\Copain;
use App\Models\RestoPasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmangeController extends Controller
{
    // Affiche la liste des copains présents pour un restopasse + liste de tous les copains pour ajout
    public function edit(RestoPasse $restopasse)
    {
        // Copains déjà présents
        $presentCopains = $restopasse->copains()->get();

        // Tous les copains disponibles (pour ajouter)
        $allCopains = Copain::all();

        return view('amange.edit', compact('restopasse', 'presentCopains', 'allCopains'));
    }

    public function store(Request $request, RestoPasse $restopasse)
    {
        $request->validate([
            'id_copain' => 'required|exists:copain,id_copain',
        ]);

        // Eviter les doublons
        if (!$restopasse->copains()->where('copain.id_copain', $request->id_copain)->exists()) {
            $restopasse->copains()->attach($request->id_copain);
        }

        return redirect()->route('amange.edit', $restopasse)->with('success', 'Copain ajouté aux présents.');
    }


    // Supprime un copain des présents
    public function destroy(RestoPasse $restopasse, Copain $copain)
    {
        $restopasse->copains()->detach($copain->id_copain);

        return redirect()->route('amange.edit', $restopasse)->with('success', 'Copain retiré des présents.');
    }

    public function index()
    {
        // Récupère les copains liés à l'user connecté
        $userId = Auth::id();

        // Charge les amanges des copains de l'user connecté avec le resto et notes
        $amanges = Amange::with(['copain', 'restopasse.restaurant'])
            ->whereHas('copain', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return view('amange.index', compact('amanges'));
    }

    // Affiche un repas via clé composite
    public function show($id_copain, $id_restopasse)
    {
        $amange = Amange::where('id_copain', $id_copain)
                        ->where('id_restopasse', $id_restopasse)
                        ->with(['restopasse.restaurant', 'copain'])
                        ->firstOrFail();

        return view('amange.show', compact('amange'));
    }

    // Formulaire de modification via clé composite
    public function crudedit($id_copain, $id_restopasse)
    {
        $amange = Amange::where('id_copain', $id_copain)
                        ->where('id_restopasse', $id_restopasse)
                        ->firstOrFail();

        return view('amange.crudedit', compact('amange'));
    }

    // Met à jour le repas
    public function update(Request $request, $id_copain, $id_restopasse)
    {
        $validated = $request->validate([
            'prix' => 'nullable|integer|min:1|max:5',
            'qualite_nourriture' => 'nullable|integer|min:1|max:5',
            'ambiance' => 'nullable|integer|min:1|max:5',
            'overall' => 'nullable|integer|min:1|max:5',
            'avis' => 'nullable|string',
        ]);

        $amange = Amange::where('id_copain', $id_copain)
                        ->where('id_restopasse', $id_restopasse)
                        ->firstOrFail();

        $amange->update($validated);

        return redirect()->route('amange.index')->with('success', 'Repas mis à jour avec succès.');
    }

    // Supprime un repas
    public function cruddestroy($id_copain, $id_restopasse)
    {
        $amange = Amange::where('id_copain', $id_copain)
                        ->where('id_restopasse', $id_restopasse)
                        ->firstOrFail();

        $amange->delete();

        return redirect()->route('amange.index')->with('success', 'Repas supprimé avec succès.');
    }
}
