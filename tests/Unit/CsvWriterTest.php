<?php

namespace Tests\Unit;

use App\Services\CsvWriterService;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CsvWriterTest extends TestCase
{
    /**
     * Asserts that the filename used in the csv writer comes from
     * the configuration value specified in config/csv.php
     */
    public function testUsesFileNameFromConfig()
    {
        Config::shouldReceive('get')
            ->with('csv.filename')
            ->once()
            ->andReturn('test_file.csv');

        $writer = new CsvWriterService();

        $data = [
            [1, 2, 3, 4],
        ];

        $writer->write($data);
    }

    /**
     * Asserts that the output file must be created if it does not exist
     * prior to writing.
     */
    public function testCreatesFileIfDoesNotExist()
    {
        $name = 'test_file.csv';
        $path = storage_path($name);

        // Ensure the file is deleted before starting.
        if (file_exists($path)) {
            unlink($path);
        }

        Config::set('csv.filename', $name);

        $writer = new CsvWriterService();

        $data = [
            [1, 2, 3, 4],
        ];

        $writer->write($data);

        $this->assertTrue(file_exists($path));
    }

    /**
     * Asserts that the contents of the file should be overwritten
     * by the new csv contents, if the file already exists.
     */
    public function testReplacesFileContentsIfNotEmpty()
    {
        $name = 'test_file.csv';
        $path = storage_path($name);

        file_put_contents($path, 'initial contents to be replaced');

        Config::set('csv.filename', $name);

        $writer = new CsvWriterService();

        $data = [
            [1, 2, 3, 4],
        ];

        $writer->write($data);

        $this->assertStringNotContainsString('to be replaced', file_get_contents($path));
    }

    /**
     * Asserts that the csv writer can successfully write multi-line csv
     * files from a multi-dim array input variable.
     */
    public function testWritesMultiLineCsv()
    {
        $name = 'test_file.csv';
        $path = storage_path($name);

        Config::set('csv.filename', $name);

        $writer = new CsvWriterService();

        $data = [
            [1, 2, 3, 4],
            [5, 6, 7, 8],
            ['string', 'one', 'two', 'three'],
        ];

        $writer->write($data);

        $contents = file_get_contents($path);

        $expected = "1,2,3,4\n5,6,7,8\nstring,one,two,three\n";

        $this->assertEquals($expected, $contents);
    }
}
