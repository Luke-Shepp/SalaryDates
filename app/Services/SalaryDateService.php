<?php

namespace App\Services;

use Carbon\CarbonImmutable;

class SalaryDateService
{
    /** @var CsvWriterService */
    private $csvWriter;

    /**
     * @param CsvWriterService $csvWriter
     */
    public function __construct(CsvWriterService $csvWriter)
    {
        $this->csvWriter = $csvWriter;
    }

    /**
     * @return bool
     */
    public function generate(): bool
    {
        $today = CarbonImmutable::today();
        $currentMonth = $today->startOfMonth();

        $output = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $currentMonth->addMonths($i);

            $output[] = [
                $month->format('M/y'),
                (new BasicPayDate($month))->getDate()->format('Y-m-d'),
                (new BonusPayDate($month))->getDate()->format('Y-m-d'),
            ];
        }

        $this->csvWriter->write($output);

        return true;
    }
}
