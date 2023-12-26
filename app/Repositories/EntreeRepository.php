<?php
namespace App\Repositories;

use App\Models\Entree;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class EntreeRepository extends RessourceRepository{
    public function __construct(Entree $entree){
        $this->model = $entree;
    }

}
