<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant","description"/*,"reglement_id","depensevehicule_id"*/,"type",
        'depense_id','vehicule_id','solde','facture_id'
    ];
    public function depense(){
        return $this->belongsTo(Depense::class);
    }
    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

}
