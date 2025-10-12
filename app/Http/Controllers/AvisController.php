<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Lieu;
use App\Models\Copain;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Afficher tous les avis d'un lieu
     */
    public function index(Request $request, Lieu $lieu)
    {
        $lieu->load('type');
        
        // Récupérer le paramètre de tri
        $sortBy = $request->get('sort', 'recent'); // Par défaut : plus récents
        
        // Construire la requête des avis
        $avisQuery = Avis::where('id_lieu', $lieu->id_lieu)
            ->with('copain');
        
        // Appliquer le tri
        switch ($sortBy) {
            case 'best_rated':
                $avisQuery->orderByDesc('note_general')->orderByDesc('created_at');
                break;
            case 'worst_rated':
                $avisQuery->orderBy('note_general')->orderByDesc('created_at');
                break;
            case 'oldest':
                $avisQuery->orderBy('created_at');
                break;
            case 'recent':
            default:
                $avisQuery->orderByDesc('created_at');
                break;
        }
        
        $avis = $avisQuery->get();
        
        // Calculer les statistiques
        $moyenneNote = $avis->avg('note_general');
        $nbRecommandations = $avis->where('reco', true)->count();
        
        return view('avis.index', compact('lieu', 'avis', 'moyenneNote', 'nbRecommandations', 'sortBy'));
    }

    /**
     * Formulaire pour créer un avis
     */
    public function create(Lieu $lieu)
    {
        // Vérifier si l'utilisateur a déjà un copain
        $copain = Copain::where('user_id', Auth::id())->first();
        
        if (!$copain) {
            return redirect()->route('copains.create')
                ->with('error', 'Vous devez d\'abord créer votre profil de copain pour laisser un avis.');
        }

        // Vérifier si le copain a déjà laissé un avis pour ce lieu
        $existingAvis = Avis::where('id_copain', $copain->id_copain)
            ->where('id_lieu', $lieu->id_lieu)
            ->first();

        if ($existingAvis) {
            return redirect()->route('avis.edit', [$lieu, $existingAvis])
                ->with('info', 'Vous avez déjà laissé un avis pour ce lieu. Vous pouvez le modifier.');
        }

        return view('avis.create', compact('lieu', 'copain'));
    }

    /**
     * Enregistrer un nouvel avis
     */
    public function store(Request $request, Lieu $lieu): RedirectResponse
    {
        $copain = Copain::where('user_id', Auth::id())->first();

        if (!$copain) {
            return redirect()->route('copains.create')
                ->with('error', 'Vous devez d\'abord créer votre profil de copain.');
        }

        $validated = $request->validate([
            'avis' => 'nullable|string',
            'note_general' => 'nullable|numeric|min:0|max:5',
            'reco' => 'boolean',
        ]);

        $validated['id_copain'] = $copain->id_copain;
        $validated['id_lieu'] = $lieu->id_lieu;

        Avis::create($validated);

        return redirect()->route('avis.index', $lieu)
            ->with('success', 'Votre avis a été ajouté avec succès.');
    }

    /**
     * Afficher un avis spécifique
     */
    public function show(Lieu $lieu, Avis $avis)
    {
        $avis->load('copain');
        return view('avis.show', compact('lieu', 'avis'));
    }

    /**
     * Formulaire d'édition d'un avis
     */
    public function edit(Lieu $lieu, Avis $avis)
    {
        $copain = Copain::where('user_id', Auth::id())->first();

        // Vérifier que l'utilisateur peut modifier cet avis
        if (!$copain || $avis->id_copain !== $copain->id_copain) {
            return redirect()->route('avis.index', $lieu)
                ->with('error', 'Vous ne pouvez pas modifier cet avis.');
        }

        return view('avis.edit', compact('lieu', 'avis', 'copain'));
    }

    /**
     * Mettre à jour un avis
     */
    public function update(Request $request, Lieu $lieu, Avis $avis): RedirectResponse
    {
        $copain = Copain::where('user_id', Auth::id())->first();

        if (!$copain || $avis->id_copain !== $copain->id_copain) {
            return redirect()->route('avis.index', $lieu)
                ->with('error', 'Vous ne pouvez pas modifier cet avis.');
        }

        $validated = $request->validate([
            'avis' => 'nullable|string',
            'note_general' => 'nullable|numeric|min:0|max:5',
            'reco' => 'boolean',
        ]);

        $avis->update($validated);

        return redirect()->route('avis.index', $lieu)
            ->with('success', 'Votre avis a été mis à jour avec succès.');
    }

    /**
     * Supprimer un avis
     */
    public function destroy(Lieu $lieu, Avis $avis): RedirectResponse
    {
        $copain = Copain::where('user_id', Auth::id())->first();

        if (!$copain || $avis->id_copain !== $copain->id_copain) {
            return redirect()->route('avis.index', $lieu)
                ->with('error', 'Vous ne pouvez pas supprimer cet avis.');
        }

        $avis->delete();

        return redirect()->route('avis.index', $lieu)
            ->with('success', 'Votre avis a été supprimé.');
    }

    /**
     * Afficher tous les avis de l'utilisateur connecté
     */
    public function mesAvis(Request $request)
    {
        $copain = Copain::where('user_id', Auth::id())->first();

        if (!$copain) {
            return redirect()->route('copains.create')
                ->with('error', 'Vous devez d\'abord créer votre profil de copain.');
        }

        // Récupérer le paramètre de tri
        $sortBy = $request->get('sort', 'recent'); // Par défaut : plus récents
        
        // Construire la requête des avis
        $avisQuery = Avis::where('id_copain', $copain->id_copain)
            ->with('lieu.type');
        
        // Appliquer le tri
        switch ($sortBy) {
            case 'best_rated':
                $avisQuery->orderByDesc('note_general')->orderByDesc('created_at');
                break;
            case 'worst_rated':
                $avisQuery->orderBy('note_general')->orderByDesc('created_at');
                break;
            case 'oldest':
                $avisQuery->orderBy('created_at');
                break;
            case 'recent':
            default:
                $avisQuery->orderByDesc('created_at');
                break;
        }
        
        $avis = $avisQuery->get();

        return view('avis.mes-avis', compact('avis', 'copain', 'sortBy'));
    }
}
