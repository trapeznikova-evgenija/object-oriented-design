<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:21
 */

namespace document;


interface DocumentInterface
{
    public function insertParagraph(string $text, ?int $position = 0) : ParagraphInterface;
    public function insertImage(string $path, int $width, int $height, ?int $position = 0) : ImageInterface;

    public function getItem(int $index) : DocumentElementInterface;
    public function deleteItem(int $index) : void;
    public function getItemsCount() : int;

    public function setTitle(string $title) : void;
    public function getTitle() : string;

    public function canUndo() : bool;
    public function undo() : void;

    public function canRedo() : bool;
    public function redo() : void;

    public function save(string $path) : void;
}