<?php
namespace App\Repositories;

use App\Models\Vehicule;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class VehiculeRepository extends RessourceRepository{
    public function __construct(Vehicule $vehicule){
        $this->model = $vehicule;
    }

    public function getVehiculeWitReglement(){
        return Vehicule::with(["facture","facture.reglements"])->get();
    }
}
