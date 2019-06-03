<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 03.06.19
 * Time: 7:31
 */

namespace App\classes;


use App\classes\common\RectD;
use App\interfaces\CanvasInterface;
use App\interfaces\ShapesInterface;
use App\interfaces\SlideInterface;

class Slide implements SlideInterface
{
    /** @var GroupShape */
    private $shapeGroup;

    /** @var double*/
    private $width;

    /** @var double*/
    private $height;

    public function __construct(double $slideWidth, double $slideHeight)
    {
        $this->width = $slideWidth;
        $this->height = $slideHeight;
    }

    public function getHeight(): double
    {
        return $this->height;
    }

    public function getWidth(): double
    {
        return $this->width;
    }

    public function getShapes(): ShapesInterface
    {
        return $this->shapeGroup;
    }

    public function draw(CanvasInterface $canvas)
    {
        $this->shapeGroup->draw($canvas);
    }
}