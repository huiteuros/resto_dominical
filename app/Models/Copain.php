<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Copain extends Model
{
    protected $table = 'copain';
    protected $primaryKey = 'id_copain';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'pseudo',
        'info'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Amange::class, 'id_copain');
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'id_copain');
    }
}
