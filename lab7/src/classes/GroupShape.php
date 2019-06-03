<?php

namespace App\classes;

use App\classes\common\Point;
use App\classes\common\RectD;
use App\classes\common\RGBAColor;
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

    public function __construct()
    {
        $this->fillStyle = $this;
        $this->outlineStyle = $this;
    }

    public function draw(CanvasInterface $canvas)
    {
        foreach ($this->shapes as $value)
        {
            $value->draw($canvas);
        }
    }

    public function getFrame(): RectD
    {
       if (empty($this->shapes))
       {
           return new RectD(0, 0, 0, 0);
       }

       $topY = PHP_FLOAT_MAX;
       $leftX = PHP_FLOAT_MAX;
       $rightX = PHP_FLOAT_MIN;
       $bottomY = PHP_FLOAT_MIN;

       foreach ($this->shapes as $value)
       {
           $frame = $value->getFrame();
           $leftTop = $frame->getLeftTop();
           $rightBottom = new Point($leftTop->getX() + $frame->getWidth(), $leftTop->getY() + $frame->getHeight());

           $leftX = min($leftX, $leftTop->getX());
           $topY = min($topY, $leftTop->getY());
           $rightX = max($rightX, $rightBottom->getX());
           $bottomY = max($bottomY, $rightBottom->getY());
       }

       $rect = new RectD($leftX, $topY,$rightX - $leftX, $bottomY - $topY);
       return $rect;
    }

    public function setFrame(RectD $rect): void
    {
        if (empty($this->shapes))
        {
            return;
        }

        $currFrame = $this->getFrame();
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