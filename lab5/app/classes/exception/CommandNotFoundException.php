<?php

namespace exception;

class CommandNotFoundException extends CommandException
{
    public function __construct(string $commandName)
    {
        parent::__construct("Error: Command not found " . $commandName);
    }
}