<?php

namespace App\Exports;

use App\Trip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TripsReport implements FromCollection, WithHeadings
{
    public $trips;

    public function __construct($trips)
    {
        $this->trips = $trips;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->trips;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
//        dd($this->trips->first()->getAttributes());
        return array_keys($this->trips->first()->getAttributes());
    }
}
