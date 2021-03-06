<?php

namespace editor;


use application\Application;
use command\CommandsMap;
use menu\Element;
use menu\Menu;
use menu\MenuInterface;

class CommandInitializer
{
    /** @var Editor */
    private $editor;

    /** @var Menu */
    private $menu;

    /** @var Application */
    private $app;

    public function __construct(Editor $editor, Menu $menu, Application $application)
    {
        $this->editor = $editor;
        $this->menu = $menu;
        $this->app = $application;
    }

    public function initialize()
    {
        $this->menu->addItem(CommandsMap::$EXIT, "Exit", $this->getExitCommand());
        $this->menu->addItem(CommandsMap::$HELP, "Help", $this->getHelpCommand());
//        $this->menu->addItem(CommandsMap::$INSERT_IMAGE, "InsertImage <position>|end <width> <height> <path>", $this->getInsertImageCommand());
        $this->menu->addItem(CommandsMap::$INSERT_PARAGRAPH, "Insert Paragraph <text> <position>|end", $this->getInsertParagraphCommand());
        $this->menu->addItem(CommandsMap::$SET_TITLE, "Set title. Args: <new title>", $this->getSetTitleCommand());
//        $this->menu->addItem(CommandsMap::$DELETE_ITEM, "DeleteItem <position>", $this->getDeleteItemCommand());
//        $this->menu->addItem(CommandsMap::$RESIZE_IMAGE, "ResizeImage <position>|end <width> <height>", $this->getResizeImageCommand());
        $this->menu->addItem(CommandsMap::$REDO, "Redo undone command", $this->getRedoCommand());
        $this->menu->addItem(CommandsMap::$UNDO, "Undo command", $this->getUndoCommand());
        $this->menu->addItem(CommandsMap::$SAVE, "Save <path>", $this->getSaveCommand());
    }

    private function getExitCommand(): callable
    {
        return function(array $commandArgs) {
            $this->app->exit();
        };
    }

    private function getSetTitleCommand(): callable
    {
        return function(array $commandArgs) {
            if (count($commandArgs) != 2)
            {
                return;
            }

            $this->editor->setTitle($commandArgs[1]);
        };
    }

    private function getInsertParagraphCommand() : callable
    {
        return function(array $commandArgs) {
            if (count($commandArgs) != 2 && count($commandArgs) != 3)
            {
                return;
            }
            $this->editor->insertParagraph($commandArgs[1], $commandArgs[2] ?? 0);
        };
    }

    private function getInsertImageCommand() : callable
    {
        return function(array $commandArgs) {
            if (count($commandArgs) != 5 && count($commandArgs) != 6)
            {
                return;
            }

            $this->editor->insertImage($commandArgs[1], $commandArgs[2], $commandArgs[3], $commandArgs[4] ?? 0);
        };
    }

    private function getUndoCommand() : callable
    {
        return function(array $commandArgs) {
            $this->editor->undo();
        };
    }

    private function getRedoCommand() : callable
    {
        return function(array $commandArgs) {
            $this->editor->redo();
        };
    }

    private function getSaveCommand() : callable
    {
        return function(array $commandArgs) {
            if (count($commandArgs) != 2)
            {
                return;
            }

            $this->editor->save($commandArgs[1]);
        };
    }

    private function getHelpCommand() : callable
    {
        return function() {
            $commands = $this->menu->getCommands();

            echo 'Commands: ' . PHP_EOL;

            /** @var Element $command */
            foreach ($commands as $command)
            {
                echo '- ' . $command->getShortcut() . ': ' . $command->getDescription() . PHP_EOL;
            }
        };
    }
}