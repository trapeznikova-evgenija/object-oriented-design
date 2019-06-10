<?php

use App\interfaces\CanvasInterface;
use App\classes\common\RectD;
use App\interfaces\GroupShapeInterface;
use App\interfaces\StyleInterface;
use App\classes\OutlineStyle;
use App\classes\common\RGBAColor;
use App\classes\Style;
use App\interfaces\OutlineStyleInterface;

class Shape implements ShapeInterface
{
    /** @var OutlineStyleInterface */
    private $outlineStyle;

    /** @var StyleInterface */
    private $fillStyle;

    public function __construct()
    {
        $this->outlineStyle = new OutlineStyle(1, new RGBAColor(255, 255, 255), true);
        $this->fillStyle = new Style(false, new RGBAColor(56, 56, 56));
    }

    public function draw(CanvasInterface $canvas)
    {
        $outlineColor = ($this->outlineStyle->isEnabled()) ? $this->outlineStyle->getColor() : new RGBAColor(255, 255, 255);
        $canvas->setLineColor($outlineColor);
        $canvas->setLineWidth($this->outlineStyle->getStrokeWidth());

        $fillColor = ($this->fillStyle->isEnabled() ? $this->fillStyle->getColor() :  new RGBAColor(255, 255, 255));
        $canvas->beginFill($fillColor);
        $this->drawShape($canvas);
        $canvas->endFill();
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

    public function getOutlineStyle(): OutlineStyleInterface
    {
        return $this->outlineStyle;
    }

    protected function drawShape(CanvasInterface $canvas)
    {

    }
}