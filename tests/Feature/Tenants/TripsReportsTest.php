<?php

namespace Tests\Feature;

use App\Exports\TripsReport;
use App\Place;
use App\Trip;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Maatwebsite\Excel\Facades\Excel;
use Tests\Tenants\TestCase;

class TripsReportsTest extends TestCase
{
    public function test_should_generate_a_general_report_of_trips()
    {
//        Excel::fake();
        $trip = factory(Trip::class)->create();
        $trip->setOrigin(factory(Place::class)->create(), now(), now());
        $trip->setDestination(factory(Place::class)->create(), now()->addHour(), now()->addDays(1));

        $trip_should_not_see = factory(Trip::class)->create();
        $trip_should_not_see->setOrigin(factory(Place::class)->create(), now()->subYear(2), now()->subYear(2)->addHour());
        $trip_should_not_see->setDestination(factory(Place::class)->create(), now()->subYear(2)->addHour(), now()->subYear(2)->addDays(1));

        $form = [
            'start_date' => now()->subWeeks(1)->toDateTimeString(),
            'end_date' => now()->addWeek()->toDateTimeString(),
            'origin' => null,
            'destination' => null,
            'carrier' => null
        ];

        $call = $this->post('api/v1/reports', $form);
        $call->dump();
//        $call->dump();
////        $call->dump();
//        $call->assertJsonFragment([
//            'rp' => $trip->rp
//        ]);
//        $call->assertJsonMissing([
//            'rp' => $trip_should_not_see->rp
//        ]);
//
//
//        $this->actingAs($this->givenUser())
//            ->get('/invoices/download/xlsx');

//        Excel::assertDownloaded('general_report.xlsx', function(TripsReport $export) use ($trip){
//            // Assert that the correct export is downloaded.
//            return $export->collection()->contains($trip->rp);
//        });

    }
}
