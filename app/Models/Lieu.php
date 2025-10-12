<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lieu extends Model
{
    protected $table = 'lieu';
    protected $primaryKey = 'id_lieu';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'adresse',
        'id_type',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'id_type');
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'id_lieu');
    }
}
