<?php

namespace App\Http\Controllers;

use App\Models\Reglement;
use App\Repositories\DepenseRepository;
use App\Repositories\MouvementRepository;
use App\Repositories\VehiculeRepository;
use DateTime;
use Illuminate\Http\Request;

class MouvementController extends Controller
{

    protected $mouvementRepository;
    protected $vehiculeRepository;
    protected $depenseRepository;
    public function __construct(MouvementRepository $mouvementRepository,DepenseRepository $depenseRepository,
    VehiculeRepository $vehiculeRepository){
        $this->mouvementRepository =$mouvementRepository;
        $this->depenseRepository = $depenseRepository;
        $this->vehiculeRepository = $vehiculeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehicules = $this->vehiculeRepository->getAll();
        $depenses = $this->depenseRepository->getAll();
        $mouvements = $this->mouvementRepository->getAll();
        return view('mouvement.index',compact('mouvements','vehicules','depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = $this->vehiculeRepository->getAll();
        $depenses = $this->depenseRepository->getAll();
      //  $mouvement = $this->mouvementRepository->getLast();
       // dd($mouvement);
        return view('mouvement.add',compact("vehicules","depenses"));
    }
    public function createEntree()
    {
        return view('mouvement.entree');
    }
    public function createSortie()
    {

        return view('mouvement.add');
    }
    public function listSortie(){
        $sorties = $this->mouvementRepository->getByType('sortie');
        return view('mouvement.sorties',compact('sorties'));
    }
    public function listEntree(){
        $entrees = $this->mouvementRepository->getByType('entree');
        return view('mouvement.entrees',compact('entrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $solde =0;
        $mouvement = $this->mouvementRepository->getLast();
        if($request["type"]=="entree"){
            if(sizeof($mouvement) > 0){
                $solde = $mouvement[0]->solde+$request["montant"];
            }else{
                $solde = $request["montant"];

            }

            $request->merge(["solde"=>$solde]);
        }else{
            $solde = $mouvement[0]->solde - $request["montant"];
            $request->merge(["solde"=>$solde]);
        }
        $mouvements = $this->mouvementRepository->store($request->all());
        if($request["type"]=="entree"){
            $reglement = new Reglement();
            $reglement->description = $request['description'];
            $reglement->montant = $request['montant'];
            $reglement->facture_id = $request['facture_id'];
            $reglement->type = "Au comptant";
            $reglement->save();
        }
        return redirect('mouvement');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mouvement = $this->mouvementRepository->getById($id);
        return view('mouvement.show',compact('mouvement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mouvement = $this->mouvementRepository->getById($id);
        return view('mouvement.edit',compact('mouvement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mouvementEdit = $this->mouvementRepository->getById($id);
        $solde =0;
        if($mouvementEdit->type=="entree"){
            $solde = $mouvementEdit->solde - $mouvementEdit->montant;
        }else{
            $solde = $mouvementEdit->solde + $mouvementEdit->montant;
        }
        if($request["type"]=="entree"){
            $solde = $solde+$request["montant"];
            $request->merge(["solde"=>$solde]);
        }else{
            $solde = $solde - $request["montant"];
            $request->merge(["solde"=>$solde]);
        }
        $this->mouvementRepository->update($id, $request->all());
        $mouvements = $this->mouvementRepository->getForModif($id);
        foreach ($mouvements as $key => $value) {
            if($value->type=="entree"){
                $solde = $value->solde+$value->montant;
            }else{
                $solde = $value->solde-$value->montant;
            }
          $this->mouvementRepository->updateSolde($value->id,$solde);
        }
        return redirect('mouvement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mouvementRepository->destroy($id);
        return redirect('mouvement');
    }
    public function getBetweenToDate(Request $request){
        $mouvements =$this->mouvementRepository->betweenToDate($request->debut,date_modify(new DateTime($request->fin), '+1 day'));
       // dd($mouvements);
        return view('mouvement.index',compact('mouvements'));
    }

}
