<?php

use App\interfaces\CanvasInterface;
use App\classes\common\RectD;
use App\interfaces\GroupShapeInterface;
use App\interfaces\StyleInterface;
use App\classes\OutlineStyle;
use App\classes\common\RGBAColor;
use App\classes\Style;

class Shape implements ShapeInterface
{
    /** @var OutlineStyle */
    private $outlineStyle;

    /** @var StyleInterface */
    private $fillStyle;

    public function draw(CanvasInterface $canvas)
    {
        $this->outlineStyle = new OutlineStyle(1, new RGBAColor(255, 255, 255), true);
        $this->fillStyle = new Style(false, new RGBAColor(56, 56, 56));
    }

    public function setFrame(RectD $rect): void
    {
        // TODO: Implement setFrame() method.
    }

    public function getFrame(): RectD
    {
        // TODO: Implement getFrame() method.
    }

    public function getGroup(): GroupShapeInterface
    {
        return null;
    }

    public function getFillStyle(): StyleInterface
    {
        return $this->fillStyle;
    }

    public function getOutlineStyle(): StyleInterface
    {
        return $this->outlineStyle;
    }
}