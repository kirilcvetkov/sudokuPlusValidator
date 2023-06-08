<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class SudokuGrid extends ArrayCollection
{
    private array $grid;

    public function __construct(array $grid = [])
    {
        $this->grid = $grid;

        parent::__construct($grid);
    }

    public function arrayColumn($column)
    {
        return array_column($this->grid, $column);
    }

    public function sectionSide(): int
    {
        return sqrt(count($this->grid));
    }
}
