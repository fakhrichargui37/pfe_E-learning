<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecon extends Model
{
    protected $fillable = [
        'titre',
        'contenu',
        'module_id',
        'type',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
