<?php

namespace history;


use command\CommandInterface;
use CommandHistoryException;

class CommandHistory
{
    private const MAX_HISTORY_LENGTH = 10;

    /** @var CommandInterface[] */
    private $executedCommandStack;

    /** @var CommandInterface[] */
    private $canceledCommandStack;

    public function __construct()
    {
        $this->executedCommandStack = [];
        $this->canceledCommandStack = [];
    }

    public function addCommand(CommandInterface $command): void
    {
        if (count($this->executedCommandStack) == self::MAX_HISTORY_LENGTH)
        {
            array_shift($this->executedCommandStack);
        }

        if (!empty($this->canceledCommandStack))
        {
            $this->canceledCommandStack = [];
        }

        array_push($this->executedCommandStack, $command);
    }

    public function canUndo(): bool
    {
        return !empty($this->executedCommandStack);
    }

    /**
     * @throws CommandHistoryException
     */
    public function undo(): void
    {
        if (!$this->canUndo())
        {
            throw new CommandHistoryException('Error: Can\'t undo command.');
        }

        $command = array_pop($this->executedCommandStack);

        $command->unexecute();

        array_push($this->canceledCommandStack, $command);
    }

    public function canRedo(): bool
    {
        return !empty($this->canceledCommandStack);
    }

    /**
     * @throws CommandHistoryException
     */
    public function redo(): void
    {
        if (!$this->canRedo())
        {
            throw new CommandHistoryException('Error: Can\'t redo command.');
        }

        $command = array_pop($this->canceledCommandStack);

        $command->execute();

        array_push($this->executedCommandStack, $command);
    }
}