<?php

namespace App\Services;

use App\Exceptions\FileException;
use Illuminate\Support\Facades\Config;

class CsvWriterService
{
    /**
     * Write an array of data to a CSV file.
     *
     * @param array $lines Multi-dimensional array: $lines[row][column] = data
     * @throws FileException
     */
    public function write(array $lines)
    {
        $fp = fopen($this->filepath(), 'w+');

        if ($fp === false) {
            throw new FileException('Unable to open specified file: ' . $this->filepath());
        }

        foreach ($lines as $line) {
            fputcsv($fp, $line);
        }

        fclose($fp);
    }

    /**
     * Builds a filepath for the output file
     *
     * @return string
     */
    private function filepath(): string
    {
        return storage_path(basename(Config::get('csv.filename')));
    }
}
