<?php

namespace App\Filament\Resources\PartResource\Pages;

use App\Filament\Resources\PartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use YOS\FilamentExcel\Actions\Import;
use App\Imports\PartsImport;

class ListParts extends ListRecords
{
    protected static string $resource = PartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Import::make()
            ->import(PartsImport::class)
            ->type(\Maatwebsite\Excel\Excel::XLSX)
            ->label('Import Parts')
            ->hint('Upload xlsx type')
            ->color('success'),
        ];
    }
}