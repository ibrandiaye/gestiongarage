<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depensevehicule extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant","description","vehicule_id"
    ];

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }
}
