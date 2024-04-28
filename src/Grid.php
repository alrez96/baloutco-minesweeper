<?php

namespace Alireza\Baloutco;

use Alireza\Baloutco\Cell;

class Grid
{
    private array $grid;
    private int $rows;
    private int $columns;
    private int $mines;

    public function __construct(int $rows = 8, int $columns = 7, int $mines = 10)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->mines = $mines;

        for ($row = 0; $row < $rows; $row++) {
            for ($column = 0; $column < $columns; $column++) {
                $this->grid[$row][$column] = new Cell($row, $column);
            }
        }

        $this->placeMines();
        $this->calculateHints();
    }

    public function printGrid(): void
    {
        for ($row = 0; $row < $this->rows; $row++) {
            for ($column = 0; $column < $this->columns; $column++) {
                echo $this->grid[$row][$column]->getData() . "\t";
            }

            echo PHP_EOL . PHP_EOL;
        }
    }

    private function placeMines(): void
    {
        $gridRows = $this->rows;
        $gridColumns = $this->columns;
        $numberOfMines = $this->mines;

        $minesPlaced = 0;

        while ($minesPlaced < $numberOfMines) {
            $row = mt_rand(0, $gridRows - 1);
            $column = mt_rand(0, $gridColumns - 1);

            if ($this->grid[$row][$column]->getData() == null) {
                $this->grid[$row][$column]->setData('M');

                $minesPlaced++;
            }
        }
    }

    private function calculateHints(): void
    {
        $gridRows = $this->rows;
        $gridColumns = $this->columns;

        for ($row = 0; $row < $gridRows; $row++) {
            for ($column = 0; $column < $gridColumns; $column++) {
                if ($this->grid[$row][$column]->getData() == null) {
                    $this->grid[$row][$column]->setData($this->sumMinesNear($row, $column));
                }
            }
        }
    }

    private function sumMinesNear(int $row, int $column): int
    {
        $gridRows = $this->rows;
        $gridColumns = $this->columns;

        $mines = 0;

        $mines += $this->checkMineAt($row - 1, $column - 1, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row - 1, $column, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row - 1, $column + 1, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row, $column + 1, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row + 1, $column + 1, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row + 1, $column, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row + 1, $column - 1, $gridRows, $gridColumns);
        $mines += $this->checkMineAt($row, $column - 1, $gridRows, $gridColumns);

        return $mines;
    }

    private function checkMineAt(int $row, int $column): bool
    {
        $gridRows = $this->rows;
        $gridColumns = $this->columns;

        if (
            $row >= 0 && $row < $gridRows
            && $column >= 0 && $column < $gridColumns
            && $this->grid[$row][$column]->getData() === 'M'
        ) {
            return 1;
        } else {
            return 0;
        }
    }
}