<?php

namespace style;


interface FillStyleEnumeratorInterface
{
    public function enumerateFillStyles(callable $func);
}