<?php

namespace App\Services;

use App\Exceptions\FileException;
use Illuminate\Support\Facades\Config;

class CsvWriterService
{
    /**
     * @param array $lines
     * @throws FileException
     */
    public function write(array $lines)
    {
        $fp = fopen($this->filename(), 'w+');

        if ($fp === false) {
            throw new FileException('Unable to open specified file: ' . $this->filename());
        }

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
