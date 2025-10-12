<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    protected $table = 'avis';
    protected $primaryKey = 'id_avis';
    public $timestamps = true;

    protected $fillable = [
        'id_copain',
        'id_lieu',
        'avis',
        'note_general',
        'reco',
    ];

    protected $casts = [
        'reco' => 'boolean',
        'note_general' => 'decimal:1',
    ];

    public function copain(): BelongsTo
    {
        return $this->belongsTo(Copain::class, 'id_copain');
    }

    public function lieu(): BelongsTo
    {
        return $this->belongsTo(Lieu::class, 'id_lieu');
    }
}
