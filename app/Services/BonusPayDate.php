<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;

class BonusPayDate extends PayDate
{
    /**
     * Calculates the bonus pay date by using either the configured "bonus day"
     * day of the month, or the first working day after this date if it falls
     * on a weekend.
     *
     * @inheritDoc
     */
    public function __construct(CarbonImmutable $month)
    {
        $payDate = $month->setDay(Config::get('salary.bonus_day'));

        if ($payDate->isWeekend()) {
            $payDate = $payDate->nextWeekday();
        }

        $this->date = $payDate;
    }
}
