<?php

namespace style;


interface EnumeratorInterface
{
    public function enumerateStyles(callable $func);
}