<?php

namespace App\Http\Controllers;

use App\Repositories\BanqueRepository;
use App\Repositories\FactureRepository;
use App\Repositories\LignefactureRepository;
use App\Repositories\MouvementRepository;
use App\Repositories\ReglementRepository;
use App\Repositories\VehiculeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $mouvementRepository;
    protected $reglementRepository;
    protected $vehiculeRepository;
    protected $factureRepository;
    protected $lignefactureRepository;
    protected $banqueRepository;
    public function __construct(MouvementRepository $mouvementRepository,ReglementRepository $reglementRepository,
    VehiculeRepository $vehiculeRepository,FactureRepository $factureRepository,
    LignefactureRepository $lignefactureRepository,BanqueRepository $banqueRepository)
    {
        $this->middleware('auth');
        $this->mouvementRepository = $mouvementRepository;
        $this->reglementRepository = $reglementRepository;
        $this->vehiculeRepository = $vehiculeRepository;
        $this->factureRepository =$factureRepository;
        $this->lignefactureRepository=$lignefactureRepository;
        $this->banqueRepository = $banqueRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sommeEntrees = $this->mouvementRepository->sommeByType("entree");
        $sommeSortie = $this->mouvementRepository->sommeByType("sortie");
        $chiffreAffaireMois = $this->mouvementRepository->chiffreAffaireduMois();
       // dd($chiffreAffaireMois);
       $sommeFacture = $this->lignefactureRepository->sommeFacture();
       $sommeReglement = $this->reglementRepository->sommeReglement();
       $banque =$this->banqueRepository->getLast();
      // dd(count($banque));
       $soledeBanque = 0;
       if(count($banque) > 0){
            $soledeBanque = $banque[0]->solde;
       }
        return view('home',compact('sommeEntrees','sommeSortie','chiffreAffaireMois','sommeFacture',
    'sommeReglement','soledeBanque'));
    }
}
