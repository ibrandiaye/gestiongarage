<?php
namespace App\Repositories;

use App\Models\Reglement;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ReglementRepository extends RessourceRepository{
    public function __construct(Reglement $reglement){
        $this->model = $reglement;
    }
    public function sommeReglement(){
        return DB::table("reglements")->sum("montant");
    }
    public function getByVehicule($vehicule){
        return DB::table("reglements")
        ->join("factures","reglements.facture_id","=","factures.id")
        ->where("factures.vehicule_id",$vehicule)
        ->select("reglements.*")
        ->get();
    }
    public function getByBanque($banque_id){
        return DB::table("reglements")->where("banque_id",$banque_id)->first();
    }
    public function sommeReglementByfactures(){
        return DB::table("reglements")
        ->select("facture_id",DB::raw('sum(montant) as montant'))
        ->groupBy("facture_id")->get();
    }

    public function sommeReglementByVehicule($vehicule){
        return DB::table("reglements")
        ->join("factures","reglements.facture_id","=","factures.id")
        ->where("factures.vehicule_id",$vehicule)
        ->select("reglements.facture_id",DB::raw('sum(reglements.montant) as montant'))
        ->groupBy("reglements.facture_id")->get();
    }
    public function sommeReglementByOnefactures($facture){
        return DB::table("reglements")
        ->where("facture_id",$facture)
        ->sum("montant");
    }
}
