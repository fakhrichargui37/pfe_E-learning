<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'specialite',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_formateur');
    }
}
