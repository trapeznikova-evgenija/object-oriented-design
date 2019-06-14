<?php

namespace editor;


interface EditorInterface
{
    public function insertParagraph();
    public function insertImage();
    public function setTitle();
    public function resizeImage();
    public function deleteItem();
    public function replaceText();
    public function undo();
    public function redo();
    public function save();

    public function printHelp() : void;
    public function printDocument() : void;
    public function handleCommand() : void;
}