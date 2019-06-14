<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:21
 */

namespace document;


use history\CommandsHistory;

class Document implements DocumentInterface
{
    /** @var string */
    private $title;

    /** @var CommandsHistory */
    private $commandsHistory;

    /** @var DocumentElementsList */
    private $elements;


    public function __construct()
    {
        $this->title = "Lorem ipsum";
    }

    public function insertParagraph(string $text, ?int $position = 0): ParagraphInterface
    {
        $paragraphDocumentElement = new ParagraphDocumentElement($text, $this->commandsHistory);

    }

    public function getItem(int $index): DocumentElementInterface
    {
        // TODO: Implement getItem() method.
    }

    public function getItemsCount(): int
    {
        // TODO: Implement getItemsCount() method.
    }

    public function getTitle(): string
    {
        // TODO: Implement getTitle() method.
    }

    public function insertImage(string $path, int $width, int $height, ?int $position = 0): ImageInterface
    {
        // TODO: Implement insertImage() method.
    }

    public function undo(): void
    {
        // TODO: Implement undo() method.
    }

    public function canUndo(): bool
    {
        // TODO: Implement canUndo() method.
    }

    public function canRedo(): bool
    {
        // TODO: Implement canRedo() method.
    }

    public function redo(): void
    {
        // TODO: Implement redo() method.
    }

    public function deleteItem(int $index): void
    {
        // TODO: Implement deleteItem() method.
    }

    public function save(string $path): void
    {
        // TODO: Implement save() method.
    }

    public function setTitle(string $title): void
    {
        // TODO: Implement setTitle() method.
    }


    private function validatePosition(int $position)
    {

    }
}