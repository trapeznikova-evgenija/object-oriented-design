<?php

namespace menu;

use command\CommandInterface;
use exception\CommandNotFoundException;

class Menu
{
    /** @var Element[] */
    private $commandMap;

    public function __construct()
    {
        $this->commandMap = [];
    }

    public function addItem(string $name, string $description, callable $callback): void
    {
        $menuItem = new Element($name, $description, $callback);
        $this->commandMap[$menuItem->getShortcut()] = $menuItem;
    }

    public function getCommands(): array
    {
        return $this->commandMap;
    }

    /**
     * @param string $commandName
     * @param array $commandStr
     * @throws CommandNotFoundException
     */
    public function executeCommand(string $commandName, array $commandStr): void
    {
        if (!isset($this->commandMap[$commandName]))
        {
            throw new CommandNotFoundException('Unknown command ' . $commandName);
        }
        $item = $this->commandMap[$commandName];
        $item->execute($commandStr);
    }
}