<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
       "vehicule_id"
    ];
    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }
    public function reglements(){
        return $this->hasMany(Reglement::class);
    }
}
