<?php
namespace App\Repositories;

use App\Models\Depensevehicule;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class DepensevehiculeRepository extends RessourceRepository{
    public function __construct(Depensevehicule $depensevehicule){
        $this->model = $depensevehicule;
    }
    public function getByVehicule($vehicule){
        return DB::table("depensevehicules")
        ->where("vehicule_id",$vehicule)
        ->get();
    }
}
