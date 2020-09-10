<?php

namespace Tests\Unit;

use App\Services\BasicPayDate;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class BasicPayDateTest extends TestCase
{
    /**
     * Asserts that basic salary is paid on the last day of the month if it falls
     * on a weekday
     */
    public function testWhenLastDayIsWeekday()
    {
        $date = new BasicPayDate(CarbonImmutable::parse('1st Jan 2020'));

        // Jan 2020 ends on a Friday, therefore this should be the date used
        $this->assertEquals('2020-01-31', $date->getDate());
    }

    /**
     * Asserts that basic salary is paid on the last working day of the month, when the
     * last day falls on a weekend.
     */
    public function testWhenLastDayIsWeekend()
    {
        $date = new BasicPayDate(CarbonImmutable::parse('1st October 2020'));

        // October 2020 ends on a Saturday, pay date should be one day prior.
        $this->assertEquals('2020-10-30', $date->getDate());
    }
}
