<?php

require '../vendor/autoload.php';

/**
 * LICENSE: This source file is subject to the MIT License that is bundled
 * with this package in the file LICENSE.md.
 *
 * @package Lumenity Framework
 * @author  Lumenity Framework
 * @license MIT License
 *
 * Lumenity Framework is a powerful and flexible PHP framework for building web applications and APIs.
 * It provides a simple and elegant syntax that helps you create clean and maintainable code.
 */

use Lumenity\Framework\config\common\app\env;
use Lumenity\Framework\config\common\app\lumenity;
use Lumenity\Framework\config\common\app\whoops;
use Lumenity\Framework\database\connection;

/**
 * Capture the environment variables
 *
 * This step captures and initializes the environment variables required
 * for the application to function properly. These variables include
 * configuration settings such as database credentials, API keys, and
 * other environment-specific parameters.
 */
env::capture();

/**
 * Capture the debug handler
 *
 * This step captures debugging information for the application. It enables
 * the debugging mode, which allows developers to monitor and analyze the
 * execution flow, identify errors, and troubleshoot issues during development.
 */
whoops::capture();

/**
 * Capture the database connection
 *
 * This step initializes and captures the database connection. It sets up
 * the database connection parameters, establishes a connection to the
 * database server, and prepares the database for use by the application.
 */
connection::getInstance();

/**
 * Run the application
 *
 * This step executes the application and handles incoming requests. It starts
 * the application server, listens for incoming HTTP requests, and dispatches
 * them to the corresponding controllers or actions based on the defined routes.
 * The application continues to run until it receives a termination signal.
 */
lumenity::run();