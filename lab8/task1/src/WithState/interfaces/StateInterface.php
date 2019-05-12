<?php

namespace WithState\interfaces;

interface StateInterface
{
    public function insertQuarter();
    public function ejectQuarter(); //вернуть монетку
    public function turnCrank(); //дергаем за рычаг
    public function dispense(); //выдача шириков пользователю

    public function toString() : string;
}