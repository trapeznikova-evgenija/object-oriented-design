<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 10.06.19
 * Time: 6:22
 */

namespace App;


use App\classes\common\RGBAColor;
use App\interfaces\OutlineStyleInterface;

class GroupOutlineStyle implements OutlineStyleInterface
{
    /** @var OutlineStylesEnumerator */
    private $enumerator;

    public function __construct(OutlineStylesEnumerator $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function getColor(): RGBAColor
    {
        $color = null;

        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use (&$color)
        {
            $color = $style->getColor();
        });

        return $color;
    }

    public function getStrokeWidth(): double
    {
        $strokeWidth = null;

        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use (&$strokeWidth)
        {
           $strokeWidth = $style->getStrokeWidth();
        });

        return $strokeWidth;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function setStrokeWidth(double $width)
    {
        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use ($width)
        {
            $style->setStrokeWidth($width);
        });
    }

    public function isEnabled(): bool
    {
        $enable = true;

        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->isEnabled();
        });

        return $enable;
    }

    public function enable(bool $enable)
    {
        $this->enumerator->enumerate(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }
}