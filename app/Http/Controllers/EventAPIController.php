<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventAPIController extends Controller
{

    protected array $where_values = ['events.id','month','year','end_month','end_year', 'display_date', 'event_groups.name as group','headline','text','media','media_credit', 'media_thumbnail', 'media_caption', 'background_color', 'background_image','background_image_description'];

    private function getSortedQuery(array $events_query):array {
    
        $events_container = [];
        
        foreach($events_query as $event):
            array_push($events_container, [
                'media'=> [
                    'url' => $event->media,
                    'credit' => $event->media_credit,
                    'caption' => $event?->media_caption
                ],
                'text' => [
                    'headline' => $event->headline,
                    'text' => $event->text
                ],
                'start_date' => [
                    'month' => $event->month,
                    'year' => $event->year
                ],
                'end_date' => [
                    'month' => $event->end_month,
                    'year' => $event->end_year
                ],
                'group' => $event->group,
                'background' => [
                    'color' => $event->background_color,
                    'alt' => $event->background_image_description,
                    'url' => $event->background_image
                ],
                'unique_id' => $event->id,
                'display_date' => $event->display_date
            ]);

        endforeach;
        
        return $events_container;
    }

    public function getProductionEvents():array {
        
        $events_query = DB::table('events')
                    ->join('event_groups', 'event_group_id', '=', 'event_groups.id')
                    ->select( ... $this->where_values)
                    ->where('publication_status_id', '=', 3)
                    ->get()
                    ->toArray();

        $events = $this->getSortedQuery($events_query);

        return [
            'title' => (new TitleAPIController)->getProductionTitle(),
            'eras' => (new EraAPIController)->getProductionEras(),
            'events' => $events
        ];
    }

    public function getStagingEvents():array {
        
        $events_query = DB::table('events')
                    ->join('event_groups', 'event_group_id', '=', 'event_groups.id')
                    ->select( ... $this->where_values)
                    ->where('publication_status_id', '=', 2)
                    ->orWhere('publication_status_id', '=', 3)
                    ->get()
                    ->toArray();

        $events = $this->getSortedQuery($events_query);

        return [
            'title' => (new TitleAPIController)->getStagingTitle(),
            'eras' => (new EraAPIController)->getStagingEras(),
            'events' => $events,
        ];
    }
}
