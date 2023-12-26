<?php
namespace App\Repositories;

use App\Models\Mouvement;
use App\Repositories\RessourceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MouvementRepository extends RessourceRepository{
    public function __construct(Mouvement $mouvement){
        $this->model = $mouvement;
    }
    public function getByType($type){
        return DB::table("mouvements")->where("type", $type)->get();
    }
    public function sommeByType($type){
        return DB::table("mouvements")->where("type", $type)->sum("montant");
    }
    public function chiffreAffaireduMois(){
        return DB::table("mouvements")->whereBetween( 'updated_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()] )->sum("montant");
    }
    public function betweenToDate($from,$to){
        return DB::table("mouvements")->whereBetween('created_at',[$from,$to])->get();

    }
    public function getLast(){
        return DB::table("mouvements")->orderBy("id", "desc")->limit(1)->get();

    }
    public function getForModif($id){
        return DB::table("mouvements")->where("id", "<",$id)->get();

    }
    public function updateSolde($id,$solde){
        return Mouvement::where('id', $id)
        ->update([
               'solde' => $solde
        ]);
    }
    public function sommeByTypeAndVehicule($type,$vehicule_id){
        return DB::table("mouvements")->where([["type", $type],["vehicule_id",$vehicule_id]])->sum("montant");
    }
    public function getByVehicule($vehicule_id){
        return DB::table("mouvements")->where("vehicule_id",$vehicule_id)->get();
    }

    public function sommeGoupByFactureByTypeAndVehicule($type,$vehicule_id){
        return DB::table("mouvements")
        ->where([["type", $type],["vehicule_id",$vehicule_id]])
        ->select("facture_id",DB::raw("sum(montant) as montant"))
        ->groupBy("facture_id")
        ->get();
    }
}
