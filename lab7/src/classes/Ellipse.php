<?php

namespace App\classes;


use App\classes\common\Point;
use App\classes\common\RectD;
use App\interfaces\CanvasInterface;

class Ellipse extends \Shape
{
    /** @var Point */
    private $center;

    /** @var double */
    private $vertRadius;

    /** @var double */
    private $horRadius;


    public function __construct(Point $center, double $hR, double $vR)
    {
        parent::__construct();

        $this->center = $center;
        $this->vertRadius = $vR;
        $this->horRadius = $hR;
    }

    public function getFrame(): RectD
    {
        $frame = new RectD($this->center->getX() - $this->horRadius, $this->center->getY() - $this->vertRadius, 2 * $this->horRadius, 2 * $this->vertRadius);
        return $frame;
    }

    public function setFrame(RectD $newFrame): void
    {
       $currFrame = $this->getFrame();
       $horizScale = $newFrame->getWidth() / $currFrame->getWidth();
       $vertScale = $newFrame->getHeight() / $currFrame->getHeight();

       $this->vertRadius = $this->vertRadius * $vertScale;
       $this->horRadius = $this->horRadius * $horizScale;
       $this->center->setX($newFrame->left + $this->horRadius);
       $this->center->setY($newFrame->top + $this->vertRadius);
    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $canvas->moveTo($this->center);
        $canvas->drawEllipse($this->center, $this->horRadius, $this->vertRadius);
    }
}