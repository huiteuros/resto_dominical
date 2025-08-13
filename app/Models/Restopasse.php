<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restopasse extends Model
{
    protected $table = 'restopasse';
    protected $primaryKey = 'id_restopasse';
    public $timestamps = true;

    protected $fillable = [
        'id_restaurant',
        'numero_dimanche',
        'date_sortie'
    ];

    protected $casts = [
        'date_sortie' => 'date',
    ];


    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Amange::class, 'id_restopasse');
    }

    public function copains()
    {
        return $this->belongsToMany(Copain::class, 'amange', 'id_restopasse', 'id_copain')->withTimestamps();
    }
}
