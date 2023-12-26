<?php
namespace App\Repositories;

use App\Models\Banque;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class BanqueRepository extends RessourceRepository{
    public function __construct(Banque $banque){
        $this->model = $banque;
    }

public function getLast(){
    return DB::table("banques")
    ->orderBy("id","desc")
    ->limit(1)
    ->get();
}
}
