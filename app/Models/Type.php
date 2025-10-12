<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'id_type';
    public $timestamps = true;

    protected $fillable = [
        'nom',
    ];

    public function lieux(): HasMany
    {
        return $this->hasMany(Lieu::class, 'id_type');
    }
}
