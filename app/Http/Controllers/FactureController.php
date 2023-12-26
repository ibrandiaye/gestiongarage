<?php

namespace App\Http\Controllers;

use App\Models\Lignefacture;
use App\Repositories\FactureRepository;
use App\Repositories\LignefactureRepository;
use App\Repositories\VehiculeRepository;
use Illuminate\Http\Request;

class FactureController extends Controller
{

    protected $factureRepository;
    protected $vehiculeRepository;
    protected $lignefactureRepository;

    public function __construct(FactureRepository $factureRepository, VehiculeRepository $vehiculeRepository,
    LignefactureRepository $lignefactureRepository){
        $this->factureRepository =$factureRepository;
        $this->vehiculeRepository = $vehiculeRepository;
        $this->lignefactureRepository = $lignefactureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = $this->factureRepository->getAllFacture();
        return view('facture.index',compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = $this->vehiculeRepository->getAll();

        return view('facture.add',compact('vehicules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicule=$this->vehiculeRepository->getById($request["vehicule_id"]);
        $factures = $this->factureRepository->store($request->only("vehicule_id"));
        $taille =sizeof($request["quantite"]);
        $quantites = $request["quantite"];
        $descriptions = $request["description"];
        $prix=$request['prixu'];
        for ($i=0; $i < $taille; $i++) {
            $ligneFacture = new Lignefacture();
            $ligneFacture->quantite = $quantites[$i];
            $ligneFacture->prixu = $prix[$i];
            $ligneFacture->description = $descriptions[$i];
            $ligneFacture->total = $prix[$i]*$quantites[$i];
            $ligneFacture->facture_id =$factures->id;
            $ligneFacture->creancer = $vehicule->nom .":".$vehicule->numero;
            $ligneFacture->save();
        }
        return redirect("facture");//->route("vehicule.show",[ $factures->vehicule_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facture = $this->factureRepository->getById($id);
        $lignefactures = $this->lignefactureRepository->getByVehicules($id);
        $total=0;
        foreach ($lignefactures as $key => $value) {
            $total = $value->total +$total;
        }
        return view('facture',compact('facture','total','lignefactures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicules = $this->vehiculeRepository->getAll();
        $facture = $this->factureRepository->getById($id);
        $ligneFactures = $this->lignefactureRepository->getByFactures($id);
        return view('facture.edit',compact('facture','vehicules','ligneFactures'));
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
        $this->lignefactureRepository->deleteByfactures($id);
        $this->factureRepository->update($id, $request->all());
        $taille =sizeof($request["quantite"]);
        $quantites = $request["quantite"];
        $descriptions = $request["description"];
        $prix=$request['prixu'];
        $vehicule=$this->vehiculeRepository->getById($request["vehicule_id"]);

        for ($i=0; $i < $taille; $i++) {
            $ligneFacture = new Lignefacture();
            $ligneFacture->quantite = $quantites[$i];
            $ligneFacture->prixu = $prix[$i];
            $ligneFacture->description = $descriptions[$i];
            $ligneFacture->total = $prix[$i]*$quantites[$i];
            $ligneFacture->facture_id =$id;
            $ligneFacture->creancer = $vehicule->nom .":".$vehicule->numero;
            $ligneFacture->save();
        }
        return redirect('facture');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->factureRepository->destroy($id);
        return redirect('facture');
    }

    public function facture($vehicule)
    {
        return view("facture.depense",compact("vehicule"));
    }
    public function getFactureByVehicule($vehicule){
        $factures = $this->factureRepository->getByVehicule($vehicule);
        return response()->json($factures);
    }
}
