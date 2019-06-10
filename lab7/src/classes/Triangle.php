<?php

namespace App;


use App\classes\common\Point;
use App\classes\common\RectD;
use App\interfaces\CanvasInterface;

class Triangle extends \Shape
{
    /** @var double */
    private $vertex1;

    /** @var double */
    private $vertex2;

    /** @var double */
    private $vertex3;

    public function __construct(Point $v1, Point $v2, Point $v3)
    {
        parent::__construct();
        $this->vertex1 = $v1;
        $this->vertex2 = $v2;
        $this->vertex3 = $v3;
    }

    public function getFrame(): RectD
    {
        $minX = min($this->vertex1->getX(), $this->vertex2->getX(), $this->vertex3->getX());
        $minY = min($this->vertex1->getY(), $this->vertex2->getY(), $this->vertex3->getY());

        $maxX = max($this->vertex1->getX(), $this->vertex2->getX(), $this->vertex3->getX());
        $maxY = max($this->vertex1->getY(), $this->vertex2->getY(), $this->vertex3->getY());

        $frameWidth = $maxX - $minX;
        $frameHeight = $maxY - $minY;

        $frame = new RectD($maxX, $minY, $frameWidth, $frameHeight);

        return $frame;
    }

    public function setFrame(RectD $newFrame): void
    {
        $oldFrame = $this->getFrame();

        $this->vertex1 = $this->updatePosition($this->vertex1, $newFrame, $oldFrame);
        $this->vertex2 = $this->updatePosition($this->vertex2, $newFrame, $oldFrame);
        $this->vertex3 = $this->updatePosition($this->vertex3, $newFrame, $oldFrame);

    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $canvas->moveTo($this->vertex1);
        $canvas->lineTo($this->vertex2);
        $canvas->lineTo($this->vertex3);
        $canvas->lineTo($this->vertex1);
    }

    private function updatePosition(Point $point, RectD $newFrame, RectD $oldFrame) : Point
    {
        $scaleX = $point->getX() - $oldFrame->left / $oldFrame->getWidth();
        $scaleY = $point->getY() - $oldFrame->top / $oldFrame->getHeight();

        $newX = $newFrame->left + $newFrame->getWidth() * $scaleX;
        $newY = $newFrame->top + $newFrame->getHeight() * $scaleY;

        return new Point($newX, $newY);
    }
}