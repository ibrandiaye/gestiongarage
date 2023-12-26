<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','description','reference','credit','solde','facture_id','debit'
    ];
}
