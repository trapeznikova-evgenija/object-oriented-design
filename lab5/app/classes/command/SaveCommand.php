<?php

namespace command;

use document\DocumentInterface;
use document\ImageControllerInterface;
use htmlRenderer\HtmlRenderer;

class SaveCommand implements CommandInterface
{
    const FILE_NAME = 'index.html';

    const IMAGE_DIRECTORY = 'images';

    /** @var DocumentInterface */
    private $document;

    /** @var string */
    private $path;

    public function __construct(DocumentInterface $document, string $path)
    {
        $this->document = $document;
        $this->path = $path;
    }

    public function execute() : void
    {
        $filePath = $this->path . '/' . self::FILE_NAME;
        $exporter = new HtmlRenderer();
        $htmlDocument = $exporter->export($this->document);

        file_put_contents($filePath, $htmlDocument);
    }

    public function unexecute() : void
    {

    }
}