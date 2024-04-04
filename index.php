<?php

require 'vendor/autoload.php';

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

use Lumenity\Framework\common\config\app\env;
use Lumenity\Framework\common\config\handler\DebugHandler;
use Lumenity\Framework\database\connection;
use Lumenity\Framework\routes\api;
use Lumenity\Framework\routes\website;
use Lumenity\Framework\Server\App;

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
 * Capture the database connection
 *
 * This step initializes and captures the database connection. It sets up
 * the database connection parameters, establishes a connection to the
 * database server, and prepares the database for use by the application.
 */
new connection();

/**
 * Capture the debug handler
 *
 * This step captures debugging information for the application. It enables
 * the debugging mode, which allows developers to monitor and analyze the
 * execution flow, identify errors, and troubleshoot issues during development.
 */
DebugHandler::capture();

/**
 * Capture the website routes
 *
 * This step defines and captures the routes for the website. Routes define
 * the URL endpoints and map them to specific controller actions or callback
 * functions. By capturing the routes, the application knows how to handle
 * incoming requests and direct them to the appropriate controllers or actions.
 */
website::capture();

/**
 * Capture the API routes
 *
 * This step defines and captures the routes for the API. API routes are used
 * to define the endpoints for the application programming interface (API) and
 * map them to specific controller actions or callback functions. By capturing
 * the API routes, the application knows how to handle incoming API requests
 * and direct them to the appropriate controllers or actions.
 */
api::capture();

/**
 * Run the application
 *
 * This step executes the application and handles incoming requests. It starts
 * the application server, listens for incoming HTTP requests, and dispatches
 * them to the corresponding controllers or actions based on the defined routes.
 * The application continues to run until it receives a termination signal.
 */
App::run();

