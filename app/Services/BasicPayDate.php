<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

class BasicPayDate extends PayDate
{
    /**
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
