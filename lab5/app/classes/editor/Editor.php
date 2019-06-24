<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 14.06.19
 * Time: 20:19
 */

namespace editor;


use document\DocumentInterface;
use history\CommandHistory;
use exception\CommandHistoryException;
use Exception;
use document\Paragraph;
use command\InsertParagraphCommand;
use command\SetTitleCommand;
use command\SaveCommand;

class Editor implements EditorInterface
{
    const IMAGES_DIRECTORY = '\\resources\\images';

    /** @var DocumentInterface */
    private $document;

    /** @var CommandHistory */
    private $commandHistory;

    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
        $this->commandHistory = new CommandHistory();
    }

    public function setTitle(string $title): void
    {
        $command = new SetTitleCommand($this->document, $title);
        $command->execute();
        $this->commandHistory->addCommand($command);
    }

    public function insertImage(string $path, int $width, int $height, ?int $position = 0): void
    {

    }

    public function insertParagraph(string $text, ?int $position = 0)
    {
        $paragraph = new Paragraph($text);
        $command = new InsertParagraphCommand($this->document, $paragraph, $position);
        $command->execute();
        $this->commandHistory->addCommand($command);
    }

    public function canUndo(): bool
    {
        return $this->commandHistory->canUndo();
    }

    /**
     * @throws CommandHistoryException
     */
    public function undo(): void
    {
        $this->commandHistory->undo();
    }

    public function canRedo(): bool
    {
        return $this->commandHistory->canRedo();
    }

    /**
     * @throws CommandHistoryException
     */
    public function redo(): void
    {
        $this->commandHistory->redo();
    }

    /**
     * @param string $path
     * @throws Exception
     */
    public function save(string $path): void
    {
        if (!is_dir($path))
        {
            throw new Exception('Directory isn\'t exists.');
        }
        $command = new SaveCommand($this->document, $path);
        $command->execute();
        $this->commandHistory->addCommand($command);
    }
}