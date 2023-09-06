<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicationStatus extends Model
{
    use HasFactory;
    
    protected $table = 'publication_status';

    public function event():HasMany {
        
        return $this->hasMany(Event::class);
    
    }

    public function era():HasMany {
        
        return $this->hasMany(Era::class);
    }

    public function title():HasMany {

        return $this->hasMany(Title::class);
    }
}
