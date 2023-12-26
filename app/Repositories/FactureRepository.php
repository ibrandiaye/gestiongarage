<?php
namespace App\Repositories;

use App\Models\Facture;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class FactureRepository extends RessourceRepository{
    public function __construct(Facture $facture){
        $this->model = $facture;
    }

    public function sommeFacture(){
        return DB::table("factures")->sum("montant");
    }
    public function getByVehicule($vehicule){
        return DB::table("factures")
        ->where("vehicule_id",$vehicule)
        ->get();
    }
    public function sommeFactureByVehicule($vehicule){
        return DB::table("factures")
        ->join("lignefactures","factures.id","=","lignefactures.facture_id")
        ->where("factures.vehicule_id",$vehicule)
        ->select("factures.id",DB::raw("sum(lignefactures.total) as montant"))
        ->groupBy("factures.id")
        ->get();
    }
    public function getFacturesOnly(){
        return DB::table("factures")
        ->get();
    }
    public function getAllFacture(){
        return Facture::with("vehicule")
        ->orderBy("id","desc")
        ->get();
    }
    public function getFactureByVehicule($vehicule_id){
        return DB::table("factures")->where("vehicule_id",$vehicule_id)->get();
    }
}
