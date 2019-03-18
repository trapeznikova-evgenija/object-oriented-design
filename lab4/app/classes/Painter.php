<?php

namespace App;


class Painter implements PainterInterface
{
    public function drawPicture(PictureDraft $pictureDraft, CanvasInterface $canvas)
    {
        for ($i = 0; $i < $pictureDraft->getShapeCount(); $i++)
        {
            $shape = $pictureDraft->getShapeAt($i);
            $shape->draw($canvas);
        }
    }
}