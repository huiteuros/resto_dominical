<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    protected $primaryKey = 'id_restaurant';
    public $timestamps = true;

    protected $fillable = [
        'nom_restau',
        'type_restau',
        'adresse_postale',
        'lien_site_web',
        'ouvert_dimanche_midi'
    ];

    public function restopasses(): HasMany
    {
        return $this->hasMany(Restopasse::class, 'id_restaurant');
    }

    public function getAvis()
    {
        return Amange::join('copain as c', 'amange.id_copain', '=', 'c.id_copain')
            ->join('restopasse as r', 'amange.id_restopasse', '=', 'r.id_restopasse')
            ->select('c.nom', 'c.prenom', 'amange.avis', 'amange.overall', 'amange.qualite_nourriture', 'amange.prix', 'amange.ambiance')
            ->where('r.id_restaurant', $this->id_restaurant)
            ->get();

    }
}
