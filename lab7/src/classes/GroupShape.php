<?php

namespace App\classes;

use App\classes\common\Point;
use App\classes\common\RectD;
use App\classes\common\RGBAColor;
use App\interfaces\CanvasInterface;
use App\interfaces\GroupShapeInterface;
use App\interfaces\OutlineStyleInterface;
use App\interfaces\StyleInterface;

class GroupShape implements GroupShapeInterface
{
    /**
     * @var OutlineStyleInterface
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

        $newFrameLeftTop = $rect->getLeftTop();
        $currFrameLeftTop = $currFrame->getLeftTop();

        $frameScaleX = $rect->getWidth() / $currFrame->getWidth();
        $frameScaleY = $rect->getHeight() / $currFrame->getHeight();

        $frameOffsetX = $newFrameLeftTop->getX() - $currFrameLeftTop->getX();
        $frameOffsetY = $newFrameLeftTop->getY() - $currFrameLeftTop->getY();

        foreach ($this->shapes as $value)
        {
            $frame = $value->getFrame();

            $frame->left = $frame->left + $frameOffsetX;
            $frame->top = $frame->top + $frameOffsetY;

            $shapeFrameOffsetX = $frame->left - $newFrameLeftTop->getX();
            $shapeFrameOffsetY = $frame->top - $newFrameLeftTop->getY();

            $frame->left = $newFrameLeftTop->getX() + ($shapeFrameOffsetX * $frameScaleX);
            $frame->top = $newFrameLeftTop->getY() + ($shapeFrameOffsetY * $frameScaleY);
            $frame->width = $frameScaleX * $frame->width;
            $frame->height = $frameScaleY * $frame->height;

            $value->setFrame($frame);
        }
    }

    public function getOutlineStyle(): OutlineStyleInterface
    {
        return $this->outlineStyle;
    }

    public function getFillStyle(): StyleInterface
    {
       return $this->fillStyle;
    }

    public function getGroup(): GroupShapeInterface
    {
        return $this;
    }

    public function getShapesCount()
    {
        return count($this->shapes);
    }

    public function getShapeAtIndex(int $index): \ShapeInterface
    {
        if (array_key_exists($index, $this->shapes))
        {
            return $this->shapes[$index];
        }

        echo "Невозможно получить фигуру по позиции: " . $index . PHP_EOL;
    }

    public function insertShape(\ShapeInterface $shape, int $position)
    {
        if (!$this->shapes[$position] = $shape)
        {
            echo "Не удалось выполнить insertShape" . PHP_EOL;
        }
    }

    public function removeShapeAtIndex(int $index): void
    {
        if (array_key_exists($index, $this->shapes))
        {
            unset($this->shapes[$index]);
        }
        else
        {
            echo "Невозможно получить фигуру по позиции: " . $index . PHP_EOL;
        }
    }

    private function enumerateOutlineStyles()
    {
        foreach ($this->shapes as $shape)
        {
            if (!$shape->getFillStyle())
            {
                break;
            }
        }
    }

    private function enumerateFillStyles()
    {

    }
}