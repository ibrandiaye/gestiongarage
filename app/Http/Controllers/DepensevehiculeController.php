<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Sortie;
use App\Repositories\DepensevehiculeRepository;
use App\Repositories\VehiculeRepository;
use Illuminate\Http\Request;

class DepensevehiculeController extends Controller
{

    protected $depensevehiculeRepository;
    protected $vehiculeRepository;

    public function __construct(DepensevehiculeRepository $depensevehiculeRepository, VehiculeRepository $vehiculeRepository){
        $this->depensevehiculeRepository =$depensevehiculeRepository;
        $this->vehiculeRepository = $vehiculeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depensevehicules = $this->depensevehiculeRepository->getAll();
        return view('depensevehicule.index',compact('depensevehicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = $this->vehiculeRepository->getAll();

        return view('depensevehicule.add',compact('vehicules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mouvement = new Mouvement();
        //$sortie = new Sortie();
       // $sortie->montant = $request->montant;
       $mouvement->montant = $request->montant;
       $mouvement->type = "sortie";
        $vehicule = $this->vehiculeRepository->getById($request->vehicule_id);
       // $sortie->description = "Depense pour le Vehicule ".$vehicule->numero." :  ".$request->description;
       $mouvement->description = "Depense pour le Vehicule ".$vehicule->numero." :  ".$request->description;
        $depensevehicules = $this->depensevehiculeRepository->store($request->all());
       // $sortie->depensevehicule_id = $depensevehicules->id;
       $mouvement->depensevehicule_id = $depensevehicules->id;
       // $sortie->save();
       $mouvement->save();
        return redirect()->route("vehicule.show",[ $depensevehicules->vehicule_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depensevehicule = $this->depensevehiculeRepository->getById($id);
        return view('depensevehicule.show',compact('depensevehicule'));
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
        $depensevehicule = $this->depensevehiculeRepository->getById($id);
        return view('depensevehicule.edit',compact('depensevehicule','vehicules'));
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
        $this->depensevehiculeRepository->update($id, $request->all());
        return redirect('depensevehicule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->depensevehiculeRepository->destroy($id);
        return redirect('depensevehicule');
    }

    public function depenseVehicule($vehicule)
    {
        return view("depensevehicule.depense",compact("vehicule"));
    }
}
