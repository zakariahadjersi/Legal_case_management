<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function agences()
    {
        return $this->hasMany(Agence::class);
    }
}
