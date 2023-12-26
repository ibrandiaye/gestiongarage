<?php
namespace App\Repositories;

use App\Models\Lignefacture;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class LignefactureRepository extends RessourceRepository{
    public function __construct(Lignefacture $lignefacture){
        $this->model = $lignefacture;
    }
    public function getByVehicules($facture){
        return DB::table("lignefactures") ->where("facture_id",$facture)->get();
    }
    public function getByFactures($facture){
        return DB::table("lignefactures") ->where("facture_id",$facture)->get();
    }
    public function sommeFacture(){
        return DB::table("lignefactures")->sum("total");
    }
    public function sommeByfactures(){
        return DB::table("lignefactures")
        ->select("facture_id","creancer",'created_at',DB::raw('sum(total) as montant'))
        ->groupBy("facture_id","creancer",'created_at')->get();
    }
    public function deleteByfactures($facture){
        return DB::table("lignefactures")
        ->select("facture_id",$facture)
        ->delete();
    }
}
