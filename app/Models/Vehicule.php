<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque','model','numero','nom','tel','sortie','panne','video'
    ];
    public function depensevehicules(){
        return $this->hasMany(Depensevehicule::class);
    }
    public function reglements(){
        return $this->hasMany(Reglement::class);
    }
    public function facture(){
        return $this->hasOne(Facture::class);
    }

}
