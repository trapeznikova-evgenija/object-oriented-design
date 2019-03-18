<?php

namespace App;


class Client
{
    private $pictureDraft;
    private $canvas;

    public function __construct(CanvasInterface $canvas)
    {
        $this->canvas = $canvas;
    }

    public function getPictureDraft(Designer $designer) : PictureDraft
    {
        return ($this->pictureDraft = $designer->createDraft());
    }

    public function drawPictureOnCanvas(Painter $painter)
    {
        $painter->drawPicture($this->pictureDraft, $this->canvas);
    }
}