<?php

namespace editor;


interface EditorInterface
{
    public function setTitle(string $title): void;
    public function insertImage(string $path, int $width, int $height, ?int $position = 0): void;
    public function insertParagraph(string $text, ?int $position = 0);
    public function canUndo(): bool;
    public function undo(): void;
    public function canRedo(): bool;
    public function redo(): void;
    public function save(string $path): void;
}