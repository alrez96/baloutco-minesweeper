<?php

namespace Alireza\Baloutco;

class Cell
{
    private int $row;
    private int $column;
    private mixed $data;
    private string $text;

    public function __construct(int $row, int $column, mixed $data = null, string $text = '')
    {
        $this->row = $row;
        $this->column = $column;
        $this->data = $data;
        $this->text = $text;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }
}