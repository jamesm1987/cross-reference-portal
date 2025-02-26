<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'part_number',
        'contents',
        'application',
        'description',
    ];

    public function competitorParts()
    {
        return $this->hasMany(CompetitorPart::class);
    }
}
