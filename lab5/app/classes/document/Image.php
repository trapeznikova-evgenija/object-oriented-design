<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 23.06.19
 * Time: 22:44
 */

namespace document;


class Image implements ImageInterface, DocumentElementInterface
{
    /** @var string */
    private $path;

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    public function __construct(string $path, float $width, float $height)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function resize(float $width, float $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function toString(): string
    {
        return "<img src='{$this->path}' width='{$this->width}' height='{$this->height}'/>";
    }
}