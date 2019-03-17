<?php

namespace App;

interface DesignerInterface
{
    public function createDraft(): PictureDraft;
}