<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EraAPIController extends Controller
{
    
    private function getSortedQuery(array $eras_query):array {
        
        $eras_container = [];

        foreach($eras_query as $era):
            
            array_push($eras_container,
            [
                'text' => [
                    'headline' => $era->headline,
                    'text' => $era->text
                ],
                'start_date' => [
                    'year' => $era->year
                ],
                'end_date' => [
                    'year' => $era->end_year
                ]
            ]
        );

        endforeach;

        return $eras_container;

    }


    public function getStagingEras():array {
       

        $eras_query = DB::table('eras')
            ->where('publication_status_id', '=', 2)
            ->orWhere('publication_status_id', '=', 3)
            ->get()
            ->toArray();


        $eras = $this->getSortedQuery($eras_query);

        return $eras;

    }

    public function getProductionEras():array {
       

        $eras_query = DB::table('eras')
            ->where('publication_status_id', '=', 3)
            ->get()
            ->toArray();


        $eras = $this->getSortedQuery($eras_query);

        return $eras;

    }
     
}
