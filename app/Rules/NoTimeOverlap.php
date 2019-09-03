<?php

namespace App\Rules;

use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Validation\Rule;

class NoTimeOverlap implements Rule
{

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
        try {
            foreach ($value as $key => $checkpoint) {
                $time_to_check_at_time = new Carbon($checkpoint['at_time']);
                $time_to_check_exiting = new Carbon($checkpoint['exiting']);

                foreach ($value as $should_not_collide) {
                    if ($should_not_collide['place_id'] !== $checkpoint['place_id']) {
                        $start = new Carbon($should_not_collide['at_time']);
                        $end = new Carbon($should_not_collide['exiting']);

                        if ($time_to_check_at_time->isBetween($start, $end) or $time_to_check_exiting->isBetween($start, $end)) {
                            return false;
                        }
                    }
                }
            }

            return true;
        } catch (\Exception $exception) {
            throw new ValidationException($exception->getMessage());
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
