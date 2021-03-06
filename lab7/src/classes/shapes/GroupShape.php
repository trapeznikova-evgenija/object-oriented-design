<?php

namespace shapes;

use common\Point;
use common\RectD;
use common\RGBAColor;
use style\EnumeratorInterface;
use style\FillStylesEnumerator;
use style\GroupOutlineStyle;
use style\GroupStyle;
use drawable\CanvasInterface;
use style\OutlineStyleEnumeratorInterface;
use style\OutlineStyleInterface;
use style\StyleInterface;
use style\OutlineStylesEnumerator;
use style\Style;

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
     * @var Shape[]
     */
    private $shapes = [];

    public function __construct()
    {
        $this->fillStyle = new GroupStyle(new FillStylesEnumerator($this->shapes));
        $this->outlineStyle = new GroupOutlineStyle(new OutlineStylesEnumerator($this->shapes));
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
       if ($this->getShapesCount() == 0)
       {
           return new RectD(0, 0, 0, 0);
       }

       $topY = PHP_INT_MAX;
       $leftX = PHP_INT_MAX;
       $rightX = PHP_INT_MIN;
       $bottomY = PHP_INT_MIN;

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

    public function getShapeAtIndex(int $index): ShapeInterface
    {
        if (array_key_exists($index, $this->shapes))
        {
            return $this->shapes[$index];
        }

        echo "Невозможно получить фигуру по позиции: " . $index . PHP_EOL;
    }

    public function insertShape(ShapeInterface $shape, int $position = null)
    {
        if ($position < 0)
        {
            echo "Вы пытаетесь вставить фигуру в несуществующую позицию" . PHP_EOL;
            return;
        }

        if (!isset($position))
        {
            $this->shapes[] = $shape;
            return;
        }

        $beginArray = array_slice($this->shapes, 0, $position);
        $endArray = array_slice($this->shapes, $position, count($this->shapes));

        $this->shapes = array_merge($beginArray, [$shape], $endArray);
    }

    public function removeShapeAtIndex(int $index): void
    {
        if (array_key_exists($index, $this->shapes))
        {
            unset($this->shapes[$index]);
            $this->shapes = array_values($this->shapes);
        }
        else
        {
            echo "Невозможно получить фигуру по позиции: " . $index . PHP_EOL;
        }
    }
}