<?php

namespace App\Console\Commands;

use App\Exceptions\FileException;
use App\Services\SalaryDateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class GenerateCsv extends Command
{
    /** @var string */
    protected $signature = 'csv:generate';

    /** @var string */
    protected $description = 'Generate a CSV containing salary payment dates for the next 12 months.';

    /** @var SalaryDateService */
    private $service;

    /**
     * @param SalaryDateService $service
     */
    public function __construct(SalaryDateService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @throws FileException
     */
    public function handle()
    {
        $this->info("Generating CSV at " . Config::get('csv.filename'));

        $this->service->generate();
    }
}
