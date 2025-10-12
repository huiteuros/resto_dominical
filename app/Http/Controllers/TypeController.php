<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
        ]);

        Type::create($validated);

        return redirect()->route('types.index')->with('success', 'Type ajouté avec succès.');
    }

    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, Type $type): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
        ]);

        $type->update($validated);

        return redirect()->route('types.index')->with('success', 'Type mis à jour avec succès.');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Type supprimé avec succès.');
    }
}
