<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    public function type():BelongsTo {
        return $this->belongsTo(Type::class);
    }

    public function event_group():BelongsTo {

        return $this->belongsTo(EventGroup::class);
    }
    
    public function publication_status():BelongsTo {
        
        return $this->belongsTo(PublicationStatus::class);
    }
}
