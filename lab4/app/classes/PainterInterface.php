<?php

namespace App;


interface PainterInterface
{
    public function drawPicture(PictureDraft $pictureDraft, CanvasInterface $canvas);
}