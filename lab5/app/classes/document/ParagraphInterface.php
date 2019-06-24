<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:23
 */

namespace document;


interface ParagraphInterface
{
    public function getText() : string;
    public function setText(string $text) : void;
}