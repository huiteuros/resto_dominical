<?php

namespace App\Http\Controllers;

use App\Models\Copain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CopainController extends Controller
{
    public function index()
    {
        $copains = Copain::with('user')->get();
        return view('copains.index', compact('copains'));
    }

    public function create()
    {
        return view('copains.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255|unique:copain,pseudo',
            'info' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création du User lié
        $user = User::create([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Création du Copain
        Copain::create([
            'user_id' => $user->id,
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'pseudo' => $validated['pseudo'],
            'info' => $validated['info'] ?? null,
        ]);

        return redirect()->route('copains.index')->with('success', 'Copain créé avec succès !');
    }

    public function show(Copain $copain)
    {
        return view('copains.show', compact('copain'));
    }

    public function edit(Copain $copain)
    {
        return view('copains.edit', compact('copain'));
    }

    public function update(Request $request, Copain $copain)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255|unique:copain,pseudo,' . $copain->id_copain . ',id_copain',
            'info' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $copain->user_id,
            // Pour simplifier, pas de modif de mot de passe ici (à gérer dans un autre controller)
        ]);

        // Met à jour l'user lié
        $user = $copain->user;
        $user->update([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
        ]);

        // Met à jour le copain
        $copain->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'pseudo' => $validated['pseudo'],
            'info' => $validated['info'] ?? null,
        ]);

        return redirect()->route('copains.index')->with('success', 'Copain modifié avec succès !');
    }

    public function destroy(Copain $copain)
    {
        // Supprime aussi le user lié (si cascade pas configuré en base)
        $copain->user()->delete();

        $copain->delete();

        return redirect()->route('copains.index')->with('success', 'Copain supprimé avec succès !');
    }
}
