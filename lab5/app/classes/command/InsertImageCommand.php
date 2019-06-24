<?php

namespace command;

use document\DocumentInterface;
use document\ImageControllerInterface;
use document\ImageInterface;

class InsertImageCommand implements CommandInterface
{
    /** @var DocumentInterface */
    private $document;

    /** @var ImageControllerInterface */
    private $imageController;

    /** @var ImageInterface */
    private $image;

    /** @var int */
    private $position;

    public function __construct(DocumentInterface $document, ImageControllerInterface $controller, ImageInterface $image, ?int $position = null)
    {
        $this->document = $document;
        $this->imageController = $controller;
        $this->image = $image;
        $this->position = $position;
    }

    public function execute() : void
    {
        if (!isset($this->position))
        {
            $this->position = $this->document->getItemsCount();
        }

        $this->document->addDocumentItem($this->image, $this->position);
        $this->imageController->unmarkAsDeleted($this->image->getPath());
    }

    public function unexecute() : void
    {
        $this->document->deleteItem($this->position);
        $this->imageController->markAsDeleted($this->image->getPath());
    }
}