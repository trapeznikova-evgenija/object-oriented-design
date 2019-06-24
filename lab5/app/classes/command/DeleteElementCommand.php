<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 23.06.19
 * Time: 22:29
 */

namespace command;


use document\DocumentElementInterface;
use document\DocumentInterface;

class DeleteElementCommand implements CommandInterface
{
    /** @var DocumentInterface */
    private $document;
    /** @var int */
    private $position;
    /** @var DocumentElementInterface */
    private $documentItem;

    public function __construct(DocumentInterface $document, int $position)
    {
        $this->document = $document;
        $this->position = $position;
    }

    public function execute(): void
    {
        $this->documentItem = $this->document->getItem($this->position);
        $this->document->deleteItem($this->position);
    }

    public function unexecute(): void
    {
        $this->document->addDocumentItem($this->documentItem, $this->position);
    }
}