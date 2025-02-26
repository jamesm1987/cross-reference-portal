<?php

namespace App\Imports;

use App\Models\Part;
use App\Models\CompetitorPart;
use App\Models\PartMeta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        if (empty($row['cht_hub']) || empty($row['contents']) || empty($row['application'])) {
            return null;
        }


        $part = Part::updateOrCreate(
            ['part_number' => $row['cht_hub']],
            [
                'contents' => $row['contents'],
                'application' => $row['application'],
                'description' => $row['description']
            ]
        );

        
        $competitorColumns = ['cv_hubs_bearings', 'universal',
            'winnards',
            'dt',
            '3g',
            'amipart',
            'fersa',
            'sampa',
            'pe',
            'febi',
            'skf',
            'fag',
            'snr'
        ];

        foreach ($row as $key => $value) {
            if ( in_array($key, $competitorColumns) && !empty($value) ) {
                $this->processCompetitorParts($part->id, $value);
            }
        }

        PartMeta::updateOrCreate(
            ['part_id' => $part->id],
            [
                'o_dia'          => $row['o_dia'] ?? null,
                'height'         => $row['height'] ?? null,
                'bearing_height' => $row['bearing_height'] ?? null,
                'bearing_o_dia'  => $row['bearing_o_dia'] ?? null,
                'bore_dia'       => $row['bore_dia'] ?? null,
                'stud_hole_dia'  => $row['stud_hole_dia'] ?? null,
                'hub_weight'     => $row['hub_weight'] ?? null,
                'bearing_weight' => $row['bearing_weight'] ?? null,
                'disc_weight'    => $row['disc_weight'] ?? null,
                'total_weight'   => $row['total_weight'] ?? null,
                'box_type'       => $row['box_type'] ?? null,
                'box_dims'       => $row['box_dims'] ?? null,
            ]
        );

        return $part;
    }

    /**
     * Handles competitor parts parsing and insertion
     */
    private function processCompetitorParts($partId, $value)
    {
        // Normalize whitespace and trim
        $value = trim(preg_replace('/\s+/', ' ', $value));

        // Distinguish between multiple numbers vs. single numbers with "/"
        if (preg_match('/[a-zA-Z0-9]+ \/ [a-zA-Z0-9]+/', $value)) {
            // If it has multiple parts (e.g., "VLHB0012 / RNHB0003 / VLHB0007")
            $partNumbers = array_map('trim', explode(' / ', $value));
        } else {
            // If it's a single part number (even if it contains "/")
            $partNumbers = [$value];
        }

        // Insert competitor part numbers
        foreach ($partNumbers as $partNumber) {
            CompetitorPart::updateOrCreate(
                ['part_id' => $partId, 'part_number' => $partNumber]
            );
        }
    }
}
