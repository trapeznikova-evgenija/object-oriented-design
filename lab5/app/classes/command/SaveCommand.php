<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 24.06.19
 * Time: 4:53
 */

namespace command;

use document\DocumentInterface;
use document\ImageControllerInterface;
use HtmlRenderer;

class SaveCommand implements CommandInterface
{
    const FILE_NAME = 'index.html';

    const IMAGE_DIRECTORY = 'images';

    /** @var DocumentInterface */
    private $document;

    /** @var string */
    private $path;

    /** @var ImageControllerInterface */
    private $imageController;

    public function __construct(DocumentInterface $document, ImageControllerInterface $controller, string $path)
    {
        $this->document = $document;
        $this->imageController = $controller;
        $this->path = $path;
    }

    public function execute() : void
    {
        $filePath = $this->path . '/' . self::FILE_NAME;
        $exporter = new HtmlRenderer();
        $htmlDocument = $exporter->export($this->document);

        file_put_contents($filePath, $htmlDocument);
        $this->imageController->deleteImageWhichMarkAsDeleted();
        $this->imageController->copyFilesToDirectory($this->path . '/' . self::IMAGE_DIRECTORY);
    }

    public function unexecute() : void
    {

    }
}