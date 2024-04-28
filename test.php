<?php

require __DIR__ . '/vendor/autoload.php';

use Alireza\Baloutco\Minesweeper;

$minesweeper = new Minesweeper();

$minesweeper->gameGrid->printGrid();