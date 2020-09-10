<?php

namespace App\Services;

use Carbon\CarbonImmutable;

abstract class PayDate
{
    /** @var CarbonImmutable */
    protected $date;

    /**
     * @param CarbonImmutable $month
     */
    abstract public function __construct(CarbonImmutable $month);

    /**
     * @return CarbonImmutable
     */
    public function getDate(): CarbonImmutable
    {
        return $this->date;
    }
}
