<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;

class BonusPayDate extends PayDate
{
    /**
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
