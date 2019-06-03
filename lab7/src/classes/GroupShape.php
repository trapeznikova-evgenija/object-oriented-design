<?php

namespace App\classes;

use App\classes\common\RectD;
use App\interfaces\CanvasInterface;
use App\interfaces\GroupShapeInterface;
use App\interfaces\StyleInterface;

class GroupShape implements GroupShapeInterface
{
    /**
     * @var Style
     */
    private $outlineStyle;

    /**
     * @var Style
     */
    private $fillStyle;

    /**
     * @var \Shape[]
     */
    private $shapes = [];

    public function draw(CanvasInterface $canvas)
    {

    }

    public function getFrame(): RectD
    {
        // TODO: Implement getFrame() method.
    }

    public function setFrame(RectD $rect): void
    {
        // TODO: Implement setFrame() method.
    }

    public function getOutlineStyle(): StyleInterface
    {
        // TODO: Implement getOutlineStyle() method.
    }

    public function getFillStyle(): StyleInterface
    {
        // TODO: Implement getFillStyle() method.
    }

    public function getGroup(): GroupShapeInterface
    {
        // TODO: Implement getGroup() method.
    }

    public function getShapesCount()
    {
        // TODO: Implement getShapesCount() method.
    }

    public function getShapeAtIndex(int $index): \ShapeInterface
    {
        // TODO: Implement getShapeAtIndex() method.
    }

    public function insertShape(\ShapeInterface $shape, int $position)
    {
        // TODO: Implement insertShape() method.
    }

    public function removeShapeAtIndex(int $index): void
    {
        // TODO: Implement removeShapeAtIndex() method.
    }
}