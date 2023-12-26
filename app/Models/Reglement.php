<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant","description","facture_id","type","banque_id"
    ];

    public function facture(){
        return $this->belongsTo(Facture::class);
    }
}
