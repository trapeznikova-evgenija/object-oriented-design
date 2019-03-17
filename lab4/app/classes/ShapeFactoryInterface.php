<?php

namespace App;


interface ShapeFactoryInterface
{
    public function createShape(string $description) : Shape;
}