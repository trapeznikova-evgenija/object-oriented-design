<?php

namespace App;


use App\classes\common\RGBAColor;
use App\interfaces\StyleInterface;

class GroupStyle implements StyleInterface
{
    /** @var FillStylesEnumerator */
    private $enumerator;

    public function __construct(FillStylesEnumerator $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function getColor(): RGBAColor
    {
        $color = null;

        $this->enumerator->enumerate(function (StyleInterface $style) use (&$color)
        {
            $color = $style->getColor();
        });

        return $color;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->enumerator->enumerate(function (StyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function isEnabled(): bool
    {
        $enable = true;

        $this->enumerator->enumerate(function (StyleInterface $style) use (&$enable)
        {
            $enable = $style->isEnabled();
        });

        return $enable;
    }

    public function enable(bool $enable)
    {
        $this->enumerator->enumerate(function (StyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }
}