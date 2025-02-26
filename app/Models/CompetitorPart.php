<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitorPart extends Model
{
    protected $fillable = [
        'part_id', 
        'competitor_name', 
        'part_number',
    ];
}
