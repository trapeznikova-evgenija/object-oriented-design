<?php

namespace command;

use document\DocumentElement;
use document\DocumentInterface;
use document\Paragraph;
use document\ParagraphInterface;

class InsertParagraphCommand implements CommandInterface
{
    /** @var DocumentInterface */
    private $document;

    /** @var ParagraphInterface */
    private $paragraph;

    /** @var int */
    private $position;

    public function __construct(DocumentInterface $document, DocumentElement $paragraph, ?int $position = null)
    {
        $this->document = $document;
        $this->paragraph = $paragraph;
        $this->position = $position;
    }

    public function execute() : void
    {
        if (!isset($this->position))
        {
            $this->position = $this->document->getItemsCount();
        }

        $this->document->addDocumentItem($this->paragraph, $this->position);
    }

    public function unexecute() : void
    {
        $this->document->deleteItem($this->position);
    }
}