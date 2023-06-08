<?php

namespace App\Service;

use SplFileObject;

class CsvService
{
    private array $contents = [];

   /**
    * Gets the contencts of the CSV file.
    *
    * @return array
    */
    public function get(): array
    {
        return $this->contents;
    }

   /**
    * Maps each cell of CSV file to integer.
    *
    * @return self
    */
    public function mapToInt(): self
    {
        foreach ($this->contents as $key => $row) {
            $this->contents[$key] = array_map('intval', $row);
        }

        return $this;
    }

   /**
    * Parses a CSV file into internal contents array.
    *
    * @return self
    */
    public function parse(SplFileObject $file): self
    {
        $this->contents = [];

        while (! $file->eof()) {
            $row = array_filter($file->fgetcsv());

            if (empty($row)) {
                break;
            }

            $this->contents[] = $row;
        }

        return $this;
    }
}
