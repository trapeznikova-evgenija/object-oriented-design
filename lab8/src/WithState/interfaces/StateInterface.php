<?php

namespace WithState;

interface StateInterface
{
    public function insertQuarter();
    public function ejectQuarter(); //вернуть монетку
    public function turnCrank(); //дергаем за рычаг
    public function dispense(); //выдача шириков пользователю

    public function toString();
}