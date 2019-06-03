<?php

namespace App\classes;


use App\classes\common\RGBAColor;
use App\interfaces\OutlineStyleInterface;

class OutlineStyle extends Style implements OutlineStyleInterface
{
    /** @var double */
    private $strokeWidth;

    public function __construct(double $strokeWidth, RGBAColor $color, bool $isEnabled)
    {
        $this->strokeWidth = $strokeWidth;

        parent::__construct($isEnabled, $color);
    }

    public function setStrokeWidth(double $width)
    {
        $this->strokeWidth = $width;
    }

    public function getStrokeWidth(): double
    {
        return $this->strokeWidth;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
       parent::setColor($RGBAColor);
    }

    public function enable(bool $enable)
    {
        parent::enable($enable);
    }

    public function isEnabled(): bool
    {
        return parent::isEnabled();
    }

    public function getColor(): RGBAColor
    {
        return parent::getColor();
    }
}