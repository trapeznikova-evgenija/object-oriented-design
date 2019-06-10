<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 10.06.19
 * Time: 6:36
 */

namespace App;


class OutlineStylesEnumerator
{
    /** @var \ShapeInterface */
    private $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    public function enumerate(callable $func)
    {
        foreach ($this->shapes as $shape)
        {
            $style = $shape->getOutlineStyle();
            call_user_func($func, $style);
        }
    }
}