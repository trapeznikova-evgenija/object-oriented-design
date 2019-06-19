<?php

namespace style;

use shapes\ShapeInterface;

class OutlineStylesEnumerator implements EnumeratorInterface
{
    /** @var ShapeInterface[] */
    private $shapes;

    public function __construct(array &$shapes)
    {
        $this->shapes = &$shapes;
    }

    public function enumerateStyles(callable $func)
    {
        foreach ($this->shapes as $shape)
        {
            $style = $shape->getOutlineStyle();
            call_user_func($func, $style);
        }
    }
}