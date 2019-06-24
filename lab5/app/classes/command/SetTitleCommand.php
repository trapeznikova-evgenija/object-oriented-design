<?php

namespace command;

use document\DocumentInterface;

class SetTitleCommand implements CommandInterface
{
    /** @var string */
    private $prevTitle;

    /** @var string */
    private $title;

    /** @var DocumentInterface */
    private $document;

    /**
     * SetTitleCommand constructor.
     * @param DocumentInterface $document
     * @param string $title
     */
    public function __construct(DocumentInterface $document, string $title)
    {
        $this->document = $document;

        $this->title = $title;
    }

    public function execute() : void
    {
        $this->prevTitle = $this->document->getTitle();
        $this->document->setTitle($this->title);
    }

    public function unexecute() : void
    {
        $this->document->setTitle($this->prevTitle);
    }
}