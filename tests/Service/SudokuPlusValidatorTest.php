<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\SudokuGrid;
use App\Service\SudokuValidationService;
use PHPUnit\Framework\TestCase;

final class SudokuPlusValidatorTest extends TestCase
{
    private SudokuValidationService $validator;
    private array $validGrid = [
        [5, 3, 4, 6, 7, 8, 9, 1, 2],
        [6, 7, 2, 1, 9, 5, 3, 4, 8],
        [1, 9, 8, 3, 4, 2, 5, 6, 7],
        [8, 5, 9, 7, 6, 1, 4, 2, 3],
        [4, 2, 6, 8, 5, 3, 7, 9, 1],
        [7, 1, 3, 9, 2, 4, 8, 5, 6],
        [9, 6, 1, 5, 3, 7, 2, 8, 4],
        [2, 8, 7, 4, 1, 9, 6, 3, 5],
        [3, 4, 5, 2, 8, 6, 1, 7, 9],
    ];

    public function setUp(): void
    {
        $this->validator = new SudokuValidationService();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidate(bool $expected, SudokuGrid $grid, array $section)
    {
        $this->validator->setGrid($grid);

        $actual = $this->validator->validate();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidateSet(bool $expected, SudokuGrid $grid, array $section)
    {
        $this->validator->setGrid($grid);

        $actual = $this->validator->validateSet($section);

        $this->assertEquals($expected, $actual);
    }

    public function testValidateShape()
    {
        $this->validator->setGrid(new SudokuGrid($this->validGrid));

        $this->assertTrue($this->validator->validateShape());

        $invalidShape = array_merge($this->validGrid, [range(1, count($this->validGrid))]);

        $this->validator->setGrid(new SudokuGrid($invalidShape));

        $this->assertFalse($this->validator->validateShape($this->validGrid));
    }

    protected function dataProvider()
    {
        $gridValid = new SudokuGrid($this->validGrid);

        $invalidGrid = $this->validGrid;
        $invalidGrid[0][0]++;
        $gridInvalid = new SudokuGrid($invalidGrid);

        return [
            'valid' => [true, $gridValid, $gridValid[0]],
            'invalid' => [false, $gridInvalid, $gridInvalid[0]],
        ];
    }
}
