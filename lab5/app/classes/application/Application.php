<?php

namespace application;

use editor\Editor;
use document\Document;
use menu\Menu;
use command\CommandsMap;
use editor\CommandInitializer;
use CommandNotFoundException;
use CommandHistoryException;

class Application
{
    private $isExit = false;

    public function run(): void
    {
        $document = new Document();
        $editor = new Editor($document);

        $menu = new Menu();

        $commandsInitializer = new CommandInitializer($editor, $menu, $this);
        $commandsInitializer->initialize();

        while (!$this->isExit)
        {
            $commandStr = readline('> ');
            $this->executeCommand($menu, $commandStr);
        }
    }

    public function exit(): void
    {
        $this->isExit = true;
    }

    private function executeCommand(Menu $menu, string $commandStr): void
    {
        try
        {
            $commandStr = $this->removeExtraSpaces($commandStr);
            $commandArgs = explode(' ', $commandStr);

            $menu->executeCommand($commandArgs[0], $commandArgs);
        }
        catch (CommandNotFoundException $exception)
        {
            echo $exception->getMessage() . PHP_EOL;
        }
        catch (CommandHistoryException $exception)
        {
            echo $exception->getMessage() . PHP_EOL;
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage() . PHP_EOL;
        }
    }

    private function removeExtraSpaces(string $line): string
    {
        return preg_replace('/^ +| +$|( ) +/m', '$1', $line);
    }
}