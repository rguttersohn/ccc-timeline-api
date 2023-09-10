<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitleAPIController extends Controller
{   

    private function sortQuery($title_query):array
{   

    $title_container = [
        'media' => [
            'url' => $title_query[0]->media,
            'caption' => $title_query[0]->caption,
            'credit' => $title_query[0]->credit,
        ],
        'text' => [
            'headline' => $title_query[0]->headline,
            'text' => $title_query[0]->text
        ],
    ];
    
    return $title_container;

}   

public function getProductionTitle(): array{

        $title_query = DB::table('titles')
            ->orderBy('updated_at', 'desc')
            ->where('publication_status_id', '=', 3)
            ->limit(1)
            ->get()
            ->toArray();
        
        $title = $this->sortQuery($title_query);
        
        return $title;
    }

public function getStagingTitle():array {

    $title_query = DB::table('titles')
        ->where('publication_status_id', '=', 2)
        ->orWhere('publication_status_id', '=', 3)
        ->orderBy('publication_status_id', 'asc')
        ->limit(1)
        ->get()
        ->toArray();

    $title = $this->sortQuery($title_query);
    
    return $title;
}
}
