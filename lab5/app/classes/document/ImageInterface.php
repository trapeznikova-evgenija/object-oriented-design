<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:23
 */

namespace document;


interface ImageInterface
{
    public function getPath(): string;
    public function getWidth(): float;
    public function getHeight(): float;
    public function resize(float $width, float $height): void;
}