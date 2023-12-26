<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Mouvement;
use App\Repositories\FactureRepository;
use App\Repositories\LignefactureRepository;
use App\Repositories\ReglementRepository;
use App\Repositories\VehiculeRepository;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
    protected $reglementRepository;
    protected $vehiculeRepository;
    protected $factureRepository;
    protected $ligneFactureRepository;

    public function __construct(ReglementRepository $reglementRepository, VehiculeRepository $vehiculeRepository,
    FactureRepository $factureRepository,LignefactureRepository $lignefactureRepository){
        $this->reglementRepository =$reglementRepository;
        $this->vehiculeRepository = $vehiculeRepository;
        $this->factureRepository = $factureRepository;
        $this->ligneFactureRepository= $lignefactureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglements = $this->reglementRepository->getAll();
        return view('reglement.index',compact('reglements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factures = $this->factureRepository->getAll();

        return view('reglement.add',compact('factures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd("eee");
       // $entree = new Entree();
        //$entree->montant = $request->montant;
        $mouvement = new Mouvement();
        $mouvement->montant = $request->montant;
        $mouvement->type = "entree";
       // $vehicule = $this->vehiculeRepository->getById($request->vehicule_id);
        //$entree->description = "Reglemnent pour le vehicule :  ".$vehicule->numero;
        $mouvement->description = "Reglemnent pour le vehicule :  ";//.$vehicule->numero;
        $reglements = $this->reglementRepository->store($request->all());
        //$entree->reglement_id = $reglements->id;
        //$entree->save();
       // $mouvement->reglement_id = $reglements->id;
       // $mouvement->save();
        return redirect('reglement');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reglement = $this->reglementRepository->getById($id);
        return view('reglement.show',compact('reglement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factures = $this->factureRepository->getAll();
        $reglement = $this->reglementRepository->getById($id);
        return view('reglement.edit',compact('reglement','factures'));
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
        $this->reglementRepository->update($id, $request->all());
        return redirect('reglement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->reglementRepository->destroy($id);
        return redirect('reglement');
    }
    public function detteClient(){


        //dd($reglementsByFacture);
        $vehicules = $this->vehiculeRepository->getVehiculeWitReglement();
       // dd($vehicules);
        $dettes=[];
        $index = 0;
        $factures =  $this->ligneFactureRepository->sommeByfactures();
        $reglementsByFacture =$this->reglementRepository->sommeReglementByfactures();
        //dd($factures);
        foreach ($factures as $key => $facture) {
            $montantFacture = $facture->montant;
           foreach ($reglementsByFacture as $keyr => $value) {
                if($facture->facture_id==$value->facture_id){
                    $montantFacture = $montantFacture -$value->montant;
                }
           }
           if($montantFacture >0){
            $dettes[$index] = new \stdClass();
            $dettes[$index]->date = $facture->created_at;
            $dettes[$index]->facture = $facture->facture_id;
            $dettes[$index]->montant = $facture->montant;
            $dettes[$index]->creancer = $facture->creancer;
            $dettes[$index]->reliquat = $montantFacture;
            $dettes[$index]->reglemment = $montantFacture;
            $index++;
           }
        }
       /*  foreach ($vehicules as $key => $value) {
        $total=0;

        foreach ($value->facture->reglements as $k => $v) {
            $total = $total + $v->montant;
        }
        $relicat = $value->facture->montant - $total;
        if($relicat > 0) {
            $dettes[$index] = new \stdClass();
            $dettes[$index]->date = $value->created_at;
            $dettes[$index]->numero = $value->id;
            $dettes[$index]->montant = $value->facture->montant;
            $dettes[$index]->creancer = $value->nom." ".$value->numero;
            $dettes[$index]->reliquat = $relicat;
            $index++;
        }
        } */
        return view("creance", compact("dettes"));
    }

}
