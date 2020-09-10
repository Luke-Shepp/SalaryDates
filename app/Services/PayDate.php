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
     * Returns a Y-m-d formatted string of the calculated date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date->format('Y-m-d');
    }
}
