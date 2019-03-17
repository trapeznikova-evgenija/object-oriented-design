<?php

namespace App;


class Painter implements PainterInterface
{
    public function drawPicture(PictureDraft $pictureDraft, Canvas $canvas)
    {
        $allShapesOnDraft = $pictureDraft->GetShapesBox();

        foreach ($allShapesOnDraft as $shape)
        {
            $shape->draw($canvas);
        }
    }
}