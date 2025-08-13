<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Amange extends Model
{
    protected $table = 'amange';
    public $incrementing = false; // Pas d'auto-incrément
    protected $primaryKey = ['id_copain', 'id_restopasse']; // Clé composite
    public $timestamps = true;

    protected $fillable = [
        'id_copain',
        'id_restopasse',
        'prix',
        'qualite_nourriture',
        'ambiance',
        'overall',
        'avis'
    ];

      // Cette fonction permet d'informer Laravel que la clé n'est pas un entier simple
    protected function setKeysForSaveQuery($query)
    {
        $query->where('id_copain', $this->getAttribute('id_copain'))
              ->where('id_restopasse', $this->getAttribute('id_restopasse'));
        return $query;
    }

    public function copain(): BelongsTo
    {
        return $this->belongsTo(Copain::class, 'id_copain');
    }

    public function restopasse(): BelongsTo
    {
        return $this->belongsTo(Restopasse::class, 'id_restopasse');
    }

    //Cette fonction retourne le nom du resto
    public function getNomRestaurant()  
    {
        return $this->restopasse->restaurant->nom_restau;
    }
}
