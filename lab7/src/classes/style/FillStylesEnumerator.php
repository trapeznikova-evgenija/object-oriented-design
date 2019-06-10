<?php

namespace style;

use shapes\ShapeInterface;

class FillStylesEnumerator
{
    /** @var ShapeInterface */
    private $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    public function enumerate(callable $func)
    {
        foreach ($this->shapes as $shape)
        {
            $style = $shape->getFillStyle();
            call_user_func($func, $style);
        }
    }
}