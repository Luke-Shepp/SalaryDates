<?php

namespace App\Services;

use App\Exceptions\FileException;
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
     * Create a CSV file detailing the dates for the next 12 months when Basic Salary
     * and Salary Bonus are paid.
     *
     * @return bool
     * @throws FileException
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
                (new BasicPayDate($month))->getDate(),
                (new BonusPayDate($month))->getDate(),
            ];
        }

        $this->csvWriter->write($output);

        return true;
    }
}
