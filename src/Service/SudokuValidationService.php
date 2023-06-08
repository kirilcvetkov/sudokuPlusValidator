<?php

namespace App\Service;

use App\Entity\SudokuGrid;

class SudokuValidationService
{
    #[ORM\Column(type: 'SudokuGrid')]
    private SudokuGrid $grid;
    private array $invalidCells = [];

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
        $shape = $this->validateShape();
        $columns = $this->validateColumns();
        $rows = $this->validateRows();
        $squareSections = $this->validateSquareSections();

        return $shape && $columns && $rows && $squareSections;
    }

   /**
    * Validates the Sudoku Plus grid.
    *
    * @return bool
    */
    public function getErrors(): array
    {
        return $this->errors;
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
        foreach ($this->grid as $key => $row) {
            if (! $this->validateSet($row)) {
                $this->setInvalidCells($key, range(0, $this->grid->count() - 1));

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
                $this->setInvalidCells(range(0, $this->grid->count() - 1), $column);

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
        for ($row = 0; $row < $this->grid->count(); $row += $this->grid->sectionSide()) {
            for ($column = 0; $column < $this->grid->count(); $column += $this->grid->sectionSide()) {
                if (! $this->validateSet($this->getSquareSection($row, $column))) {
                    $this->setInvalidCells(
                        range($row, $row + $this->grid->sectionSide() - 1),
                        range($column, $column + $this->grid->sectionSide() - 1),
                    );

                    return false;
                }
            }
        }

        return true;
    }

   /**
    * Get a square section from Sudoku Plus grid.
    *
    * @return int[]
    */
    public function getSquareSection(int $row, int $column): array
    {
        $square = [];

        for ($i = 0; $i < $this->grid->sectionSide(); $i++) {
            $square = array_merge(
                $square,
                array_slice($this->grid->get($row + $i), $column, $this->grid->sectionSide())
            );
        }

        return $square;
    }

   /**
    * Get found invalid cells from the Sudoku Plus grid.
    *
    * @return int[][]
    */
    public function getInvalidCells(): array
    {
        return $this->invalidCells;
    }

   /**
    * Set invalid cells from the Sudoku Plus grid.
    */
    public function setInvalidCells($row, $column): void
    {
        if (! is_array($row)) {
            $row = [$row];
        }

        if (! is_array($column)) {
            $column = [$column];
        }

        foreach ($row as $rowKey) {
            foreach ($column as $colKey) {
                $this->invalidCells[$rowKey][$colKey] = true;
            }
        }
    }
}
