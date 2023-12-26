<?php

namespace App\Http\Controllers;

use App\Imports\ImportBanque;
use App\Models\Reglement;
use App\Repositories\BanqueRepository;
use App\Repositories\FactureRepository;
use App\Repositories\ReglementRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BanqueController extends Controller
{
    protected $banqueRepository;
    protected $factureRepository;
    protected $reglementRepository;

    public function __construct(BanqueRepository $banqueRepository, FactureRepository $factureRepository,
    ReglementRepository $reglementRepository){
        $this->banqueRepository =$banqueRepository;
        $this->factureRepository = $factureRepository;
        $this->reglementRepository = $reglementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banques = $this->banqueRepository->getAll();
        return view('banque.index',compact('banques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factures = $this->factureRepository->getAll();
        return view('banque.add',compact('factures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banques = $this->banqueRepository->store($request->all());
        return redirect('banque');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banque = $this->banqueRepository->getById($id);
        return view('banque.show',compact('banque'));
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
        $banque = $this->banqueRepository->getById($id);
        return view('banque.edit',compact('banque','factures'));
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
        if($request["facture_id"]){
            $reglement =$this->reglementRepository->getByBanque($id);
            if($reglement){
                Reglement::where('id', $reglement->id)
                ->update([
                       'montant' => $request["debit"],
                       'facture_id'=>$request["facture_id"],

                ]);
            }else{
                $reglemmentSave = new Reglement();
                $reglemmentSave->montant=$request["debit"];
                $reglemmentSave->facture_id=$request["facture_id"];
                $reglemmentSave->type="banque";
                $reglemmentSave->banque_id=$id;
                $reglemmentSave->description="Paiement banque";
                $reglemmentSave->save();
            }
        }
        $this->banqueRepository->update($id, $request->all());

        return redirect('banque');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->banqueRepository->destroy($id);
        return redirect('banque');
    }
    public function importBanque(Request $request){
        try {

            Excel::import(new ImportBanque,$request['doc']);

          } catch (\Exception $e) {

            return \redirect("banque")->with('error','Erreur: merci de verifier Ton fichier Excel'.$e);;
          }

        return \redirect("banque");
    }

}
