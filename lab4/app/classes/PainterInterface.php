<?php

namespace App;


interface PainterInterface
{
    public function drawPicture(PictureDraft $pictureDraft, Canvas $canvas);
}