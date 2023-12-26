<?php

namespace App\Imports;

use App\Models\Banque;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportBanque implements ToArray,WithHeadingRow
{
    public function array(array $data)
    {

       //dd($data);
        foreach ($data as $key => $cni) {
           /* $commune = DB::table('communes')
            ->where('nomc',$cni['commune'])
            ->first();*/
           // var_dump($commune);
          //dd(date('Y-m-d',strtotime($cni['datz'])));
           Banque::create([
                "description"=>$cni['description'],
                "reference"=>$cni['reference'],
                "date"=>date('Y-m-d',strtotime($cni['date'])),
                "credit"=>$cni['credit'],
                "debit"=>$cni['debit'],
                "solde"=>$cni['solde']
            ]);


            }

    }
}
