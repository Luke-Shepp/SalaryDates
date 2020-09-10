<?php

namespace Tests\Unit;

use App\Services\BonusPayDate;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BonusPayDateTest extends TestCase
{
    /**
     * Asserts that bonuses are paid on the configured day if it falls on a weekday
     */
    public function testWhenDayIsWeekday()
    {
        Config::set('salary.bonus_day', 15);

        $date = new BonusPayDate(CarbonImmutable::parse('1st Jan 2020'));

        // 15th Jan 2020 is a Wednesday, therefore this is the date that should be used.
        $this->assertEquals('2020-01-15', $date->getDate());
    }

    /**
     * Assert that bonuses are paid on the first following weekday if the configured
     * day falls on a weekend.
     */
    public function testWhenDayIsWeekend()
    {
        Config::set('salary.bonus_day', 18);

        $date = new BonusPayDate(CarbonImmutable::parse('1st Jan 2020'));

        // 18th Jan 2020 is a Saturday, therefore the following Monday (20th) should be used
        $this->assertEquals('2020-01-20', $date->getDate());
    }
}
