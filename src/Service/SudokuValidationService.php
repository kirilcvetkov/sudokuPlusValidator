<?php

namespace App\Service;

use App\Entity\SudokuGrid;

class SudokuValidationService
{
    #[ORM\Column(type: 'SudokuGrid')]
    private SudokuGrid $grid;

   /**
    * Gets the Sudoku Plus grid.
    *
    * @return SudokuGrid
    */
    public function getGrid(): SudokuGrid
    {
        return $this->grid;
    }

   /**
    * Sets the Sudoku Plus grid.
    *
    * @return self
    */
    public function setGrid(SudokuGrid $grid): self
    {
        $this->grid = $grid;

        return $this;
    }

   /**
    * Validates the Sudoku Plus grid.
    *
    * @return bool
    */
    public function validate(): bool
    {
        return $this->validateShape()
            && $this->validateRows()
            && $this->validateColumns()
            && $this->validateSquareSections();
    }

   /**
    * Validates the Sudoku Plus set of numbers
    * The numbers that can be used are in the range from 1 to N where N is the length of a side.
    *
    * @return bool
    */
    public function validateSet(array $numbers): bool
    {
        return $this->grid->count() === count($numbers)
            && array_sum(range(1, $this->grid->count())) === array_sum($numbers);
    }

   /**
    * Validates the Sudoku Plus shape
    * The grid will be square (same number of rows and columns).
    * The length of a side should have an integer value square root. Valid side lengths would include: 4, 9,16, etc.
    *
    * @return bool
    */
    public function validateShape(): bool
    {
        return $this->grid->count() === count($this->grid[0])
            && gmp_perfect_square($this->grid->count());
    }

   /**
    * Validates Sudoku Plus columns within the grid.
    *
    * @return bool
    */
    public function validateRows(): bool
    {
        foreach ($this->grid as $row) {
            if (! $this->validateSet($row)) {
                return false;
            }
        }

        return true;
    }

   /**
    * Validates Sudoku Plus columns within the grid.
    *
    * @return bool
    */
    public function validateColumns(): bool
    {
        for ($column = 0; $column < $this->grid->count(); $column++) {
            if (! $this->validateSet($this->grid->arrayColumn($column))) {
                return false;
            }
        }

        return true;
    }

   /**
    * Validates all Sudoku Plus sections within the grid.
    *
    * @return bool
    */
    public function validateSquareSections(): bool
    {
        $sectionSize = sqrt($this->grid->count());

        for ($row = 0; $row < $this->grid->count(); $row += $sectionSize) {
            for ($column = 0; $column < $this->grid->count(); $column += $sectionSize) {
                if (! $this->validateSet($this->getSquareSection($row, $column, $sectionSize))) {
                    return false;
                }
            }
        }

        return true;
    }

   /**
    * Get a square sectioon from Sudoku Plus grid.
    *
    * @return int[]
    */
    public function getSquareSection(int $row, int $column, int $sectionSize): array
    {
        $square = [];

        for ($i = 0; $i < $sectionSize; $i++) {
            $square = array_merge($square, array_slice($this->grid->get($row + $i), $column, $sectionSize));
        }

        return $square;
    }
}
