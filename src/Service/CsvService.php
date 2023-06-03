<?php

namespace App\Service;

use SplFileObject;

class CsvService
{
    private array $contents = [];

    public function get(): array
    {
        return $this->contents;
    }

    public function mapToInt(): self
    {
        foreach ($this->contents as $key => $row) {
            $this->contents[$key] = array_map('intval', $row);
        }

        return $this;
    }

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
