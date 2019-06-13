<?php

namespace style;


interface OutlineStyleEnumeratorInterface
{
    public function enumerateOutlineStyles(callable $func);
}