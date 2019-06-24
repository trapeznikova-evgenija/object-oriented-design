<?php

namespace menu;

use command\CommandInterface;

class Element
{
    /** @var string */
    public $shortcut;

    /** @var string */
    public $description;

    /** @var callable */
    public $command;

    public function __construct(string $shortcut, string $description, callable $command)
    {
        $this->shortcut = $shortcut;
        $this->description = $description;
        $this->command = $command;
    }

    public function getShortcut() : string
    {
        return $this->shortcut;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function execute(array $command)
    {
        call_user_func($this->command, $command);
    }
}