<?php

namespace command;


interface CommandInterface
{
    public function execute();
    public function unexecute();
}