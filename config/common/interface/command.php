<?php

// Namespace declaration for the command interface
namespace Lumenity\Framework\config\common\interface;

// Importing the App class from the Rakit\Console namespace
use Rakit\Console\App;

/**
 * Interface command
 *
 * This interface is used to define the contract for command classes.
 * It requires the implementation of a create method.
 */
interface command
{
    /**
     * Method create
     *
     * This method is used to create a new command.
     * It accepts an instance of the App class and an optional name for the command.
     *
     * @param App $app An instance of the App class.
     */
    public function create(App $app, array $args, array $option): void;
}