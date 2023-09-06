<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Era extends Model
{
    use HasFactory;

    public function publication_status ():BelongsTo {

        return $this->belongsTo(PublicationStatus::class);
        
    }

}
