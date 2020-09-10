<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

class BasicPayDate extends PayDate
{
    /**
     * Calculates the basic pay date by finding the last weekday of the given month
     *
     * @inheritDoc
     */
    public function __construct(CarbonImmutable $month)
    {
        $this->date = CarbonPeriod::between($month, $month->endOfMonth())
            ->filter('isWeekday')
            ->last()
            ->toImmutable();
    }
}
