<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class CsvWriterService
{
    /**
     * @param array $lines
     */
    public function write(array $lines)
    {
        $fp = fopen($this->filename(), 'w+');

        foreach ($lines as $line) {
            fputcsv($fp, $line);
        }

        fclose($fp);
    }

    /**
     * @return string
     */
    private function filename(): string
    {
        return storage_path(Config::get('csv.filename'));
    }
}
