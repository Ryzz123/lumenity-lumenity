<?php

namespace Lumenity\Framework\common\config\app;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Logging Configuration
 *
 * This class provides methods to configure logging for the application
 * using the Monolog library.
 */
class log
{
    /** @var Logger The logger instance */
    private static Logger $logger;

    /**
     * Get Logger Instance
     *
     * Returns the logger instance.
     *
     * @return Logger The logger instance
     */
    private static function getLogger(): Logger
    {
        if (!isset(self::$logger)) {
            self::$logger = new Logger('application');
            self::$logger->pushHandler(new StreamHandler(__DIR__ . '/../../../bootstrap/log/application.log'));
        }
        return self::$logger;
    }

    /**
     * Log Message
     *
     * Logs a message with the specified log level.
     *
     * @param int $level The log level (100 - DEBUG, 200 - INFO, 250 - NOTICE, 300 - WARNING, 400 - ERROR, 500 - CRITICAL, 550 - ALERT, 600 - EMERGENCY)
     * @param string $message The message to be logged
     * @return void
     */
    private static function logMessage(int $level, string $message): void
    {
        self::getLogger()->log($level, $message);
    }

    // Define methods for logging messages with various log levels

    /**
     * Log Warning Message
     *
     * Logs a warning message.
     *
     * @param string $message The warning message to be logged
     * @return void
     */
    public static function warning(string $message): void
    {
        self::logMessage(300, $message);
    }

    /**
     * Log Info Message
     *
     * Logs an informational message.
     *
     * @param string $message The informational message to be logged
     * @return void
     */
    public static function info(string $message): void
    {
        self::logMessage(200, $message);
    }

    /**
     * Log Error Message
     *
     * Logs an error message.
     *
     * @param string $message The error message to be logged
     * @return void
     */
    public static function error(string $message): void
    {
        self::logMessage(400, $message);
    }

    /**
     * Log Debug Message
     *
     * Logs a debug message.
     *
     * @param string $message The debug message to be logged
     * @return void
     */
    public static function debug(string $message): void
    {
        self::logMessage(100, $message);
    }

    /**
     * Log Critical Message
     *
     * Logs a critical message.
     *
     * @param string $message The critical message to be logged
     * @return void
     */
    public static function critical(string $message): void
    {
        self::logMessage(500, $message);
    }

    /**
     * Log Alert Message
     *
     * Logs an alert message.
     *
     * @param string $message The alert message to be logged
     * @return void
     */
    public static function alert(string $message): void
    {
        self::logMessage(550, $message);
    }

    /**
     * Log Emergency Message
     *
     * Logs an emergency message.
     *
     * @param string $message The emergency message to be logged
     * @return void
     */
    public static function emergency(string $message): void
    {
        self::logMessage(600, $message);
    }

    /**
     * Log Notice Message
     *
     * Logs a notice message.
     *
     * @param string $message The notice message to be logged
     * @return void
     */
    public static function notice(string $message): void
    {
        self::logMessage(250, $message);
    }
}
