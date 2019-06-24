<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 24.06.19
 * Time: 4:08
 */

class CommandNotFoundException extends CommandException
{
    public function __construct(string $commandName)
    {
        parent::__construct("Error: Command not found " . $commandName);
    }
}