<?php
namespace App\Repositories;

use App\Models\Achat;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class AchatRepository extends RessourceRepository{
    public function __construct(Achat $achat){
        $this->model = $achat;
    }

    public function betweenToDate($from,$to){
        return DB::table("achats")->whereBetween('created_at',[$from,$to])->get();

    }
}
