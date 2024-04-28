<?php

namespace Alireza\Baloutco;

use Alireza\Baloutco\Grid;

class Minesweeper
{
    public Grid $gameGrid;

    public function __construct()
    {
        $this->gameGrid = new Grid();
    }
}