<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignefacture extends Model
{
    use HasFactory;
    protected $fillable = [
        "total","description","facture_id","quantite","prixu","creancer"
    ];

}
