<?php

namespace App\Http\Controllers;

use App\Repositories\DepensevehiculeRepository;
use App\Repositories\FactureRepository;
use App\Repositories\MouvementRepository;
use App\Repositories\ReglementRepository;
use App\Repositories\VehiculeRepository;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    protected $vehiculeRepository;
    protected $depensevehiculeRepository;
    protected $reglementRepository;
    protected $mouvementRepository;
protected $factureRepository;
    public function __construct(VehiculeRepository $vehiculeRepository,DepensevehiculeRepository $depensevehiculeRepository,
    ReglementRepository $reglementRepository,MouvementRepository $mouvementRepository,
    FactureRepository $factureRepository){
        $this->vehiculeRepository =$vehiculeRepository;
        $this->depensevehiculeRepository = $depensevehiculeRepository;
        $this->reglementRepository = $reglementRepository;
        $this->mouvementRepository = $mouvementRepository;
        $this->factureRepository =$factureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicules = $this->vehiculeRepository->getAll();
        return view('vehicule.index',compact('vehicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicule.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['vid']){
            $files = $request['vid'];
                $destinationPath = 'video/'; // upload path
                $nomImage = time().".". $files->getClientOriginalExtension();
                $files->move($destinationPath, $nomImage);
                $request->merge(['video'=>$nomImage]);

            }
        $vehicules = $this->vehiculeRepository->store($request->all());
        return redirect('vehicule');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule = $this->vehiculeRepository->getById($id);
        $depensevehicules = $this->mouvementRepository->sommeGoupByFactureByTypeAndVehicule("sortie",$id);
     //  dd($depensevehicules);
        $reglements = $this->reglementRepository->sommeReglementByVehicule($id);
       // dd($depensevehicules);
        $depense =0;
        $montantRecu = 0;
        $facture = 0;
        $factures = $this->factureRepository->sommeFactureByVehicule($id);
        $factureVehicules=[];
       // dd($factures);
        $factureByVehicules=$this->factureRepository->getFactureByVehicule($id);
        foreach ($factureByVehicules as $key => $value) {
            $factureVehicule =new \stdClass();
            $factureVehicule->numero = $value->id;
            $factureVehicule->montant = 0;
            $factureVehicule->reglement = 0;
            $factureVehicule->depense = 0;
           // $factureVehicules->push($factureVehicule);
           array_push($factureVehicules,$factureVehicule);

        }
       /*  $factures =$this->factureRepository->getByVehicule($id);
        foreach ($factures as $key => $value) {
            $facture = $facture +$value->montant;
        } */
        foreach ($factureVehicules as $key => $value) {
            foreach ($depensevehicules as $key => $valueV) {
                if($value->numero==$valueV->facture_id){
                    $factureVehicules[$key]->depense = $valueV->montant;
                }
            }
            foreach ($reglements as $key => $valueR) {
                if($value->numero==$valueR->facture_id){
                    $factureVehicules[$key]->reglement = $valueR->montant;
                }
            }
            foreach ($factures as $key => $valueF) {
                if($value->numero==$valueF->id){
                    $factureVehicules[$key]->montant = $valueF->montant;
                }
            }
        }
        foreach ($depensevehicules as $key => $value) {
                $depense = $value->montant+$depense;
        }
        foreach ($reglements as $key => $value) {
            $montantRecu = $value->montant+$montantRecu;

        }
        foreach ($factures as $key => $value) {
            $facture = $value->montant+$facture;

        }
      //  dd($factureVehicules);

        return view('vehicule.show',compact('vehicule',
    "depense","montantRecu",'facture',"factureVehicules"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $vehicule = $this->vehiculeRepository->getById($id);
        return view('vehicule.edit',compact('vehicule'));
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
        if($request['vid']){
            $files = $request['vid'];
                $destinationPath = 'video/'; // upload path
                $nomImage = time().".". $files->getClientOriginalExtension();
                $files->move($destinationPath, $nomImage);
                $request->merge(['video'=>$nomImage]);

            }
        $this->vehiculeRepository->update($id, $request->all());
        return redirect('vehicule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->vehiculeRepository->destroy($id);
        return redirect('vehicule');
    }
    public function facture($id)
    {
        $vehicule=$this->vehiculeRepository->getById($id);
        return view('facture',compact('vehicule'));
    }
}
