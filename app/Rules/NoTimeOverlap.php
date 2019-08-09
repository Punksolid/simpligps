<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class NoTimeOverlap implements Rule
{
    private $checkpoints;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $key => $checkpoint) {
            $time_to_check_at_time = new Carbon($checkpoint['at_time']);
            $time_to_check_exiting = new Carbon($checkpoint['exiting']);

            foreach ($value as $should_not_collide) {
                if ($should_not_collide['place_id'] !== $checkpoint['place_id']) {
                    $start = new Carbon($should_not_collide['at_time']);
                    $end = new Carbon($should_not_collide['exiting']);

                    return $this->intervalColidesWithAnotherInterval(
                        $time_to_check_at_time,
                        $time_to_check_exiting,
                        $start,
                        $end
                    );
                }
            }
        }

        return true;
    }

    /**
     * Revisa si la fecha de entrada del checkpoint está dentro de las fechas de entrada y salida de otro checkpoint
     * O si acado la fecha de salida del checkpoint está dentro de las fechas de entrada y salida de otro endpoint
     *
     * @param Carbon $time_to_check_at_time
     * @param Carbon $time_to_check_exiting
     * @param Carbon $start
     * @param Carbon $end
     * @return bool
     */
    public function intervalColidesWithAnotherInterval(
        Carbon $time_to_check_at_time,
        Carbon $time_to_check_exiting,
        Carbon $start,
        Carbon $end
    ): ?bool {
        if ($time_to_check_at_time->isBetween($start, $end) or $time_to_check_exiting->isBetween($start, $end)) {
            return false;
        }
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
