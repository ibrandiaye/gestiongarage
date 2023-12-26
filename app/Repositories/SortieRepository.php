<?php
namespace App\Repositories;

use App\Models\Sortie;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class SortieRepository extends RessourceRepository{
    public function __construct(Sortie $sortie){
        $this->model = $sortie;
    }

}
