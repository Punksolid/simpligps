<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Validation\Rule;

class NoTimeOverlap implements Rule
{
    private $checkpoints;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
//        $this->checkpoints = $checkpoints;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        foreach ($value as $key => $checkpoint) {
            $time_to_check_at_time = new Carbon($checkpoint['at_time']);
            $time_to_check_exiting = new Carbon($checkpoint['exiting']);

            foreach ($value as $should_not_collide) {
                if ($should_not_collide['place_id'] != $checkpoint['place_id']){
                    $start = new Carbon($should_not_collide['at_time']);
                    $end = new Carbon($should_not_collide['exiting']);

                    if ($time_to_check_at_time->isBetween($start, $end) OR $time_to_check_exiting->isBetween($start,$end)){
                        return false;
                    }
                }

            }
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Place :attribute times overlaps.';
    }
}