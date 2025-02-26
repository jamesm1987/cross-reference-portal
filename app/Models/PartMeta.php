<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartMeta extends Model
{
    protected $fillable = [
        'o_dia',
        'height',
        'bearing_height',
        'bearing_o_dia',
        'bore_diameter',
        'stud_hole_dia',
        'hub_weight',
        'bearing_weight',
        'disc_weight',
        'total_weight',
        'box_type',
        'box_dimension',
    ];

    public function part()
    {
        return $this->hasOne(Part::class);
    }
}
