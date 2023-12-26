<?php
namespace App\Repositories;

use App\Models\Depense;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class DepenseRepository extends RessourceRepository{
    public function __construct(Depense $depense){
        $this->model = $depense;
    }


}
