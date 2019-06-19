<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 19.06.19
 * Time: 18:27
 */

namespace style;


use shapes\ShapeInterface;

class FillStylesEnumerator implements EnumeratorInterface
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
            $style = $shape->getFillStyle();
            call_user_func($func, $style);
        }
    }

}