## Salary Pay Date Service

This application utilises a console command to generate and store a CSV file of salary payment dates.

The framework used is [Lumen](https://lumen.laravel.com/), this is a lightweight version of [Laravel](https://laravel.com/) intended for API's, therefore fits the use of this simple CLI project more than the full-featured version of Laravel.

#### Pay Dates

| Type | Rule |
|---|---|
| Basic | Last working day of the month (Monday - Friday). |
| Bonus | 10th of each month, or the next working day if the 10th is a weekend. |

# Usage

For initial setup, it is required to install dependencies using the following command:
```shell script
composer install
```

A .env file should be created, this can be based on the example file and can be duplicated with:

```shell script
cp .env.example .env
```

Once dependencies have been installed, and a .env file exists, run the application using:

```shell script
php artisan csv:generate
```

Upon completion, a CSV file will be available in the `storage` directory of the project root.

There are various settings which may be configured, these can be seen in the `config/` directory, 
or by examining the env file and changing environment variables where appropriate.

## Tests

This project contains various tests utilising PHPUnit. The full test suite can be ran using the following 
command from the project root:

```shell script
phpunit
```

To specify a specific test or a test class, use the `--filter` option, for example

```shell script
phpunit --filter CsvWriterTest
```

## Dependencies

- PHP 7.2+
- Lumen

## Contributing

- All code added to this project should adhere to PSR-2 standards. 
- Docblocks must be added where applicable, and maintained with any modifications.
