<?php

namespace Lumenity\Framework\config\common\app;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

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
            date_default_timezone_set('Asia/Jakarta');
            $logFile = __DIR__ . '/../../../storage/log/application.log';
            $rotatingHandler = new RotatingFileHandler($logFile, 30, Logger::DEBUG);
            $rotatingHandler->setFilenameFormat('{filename}-{date}', 'Y-m-d');
            self::$logger = new Logger('application');
            self::$logger->pushHandler($rotatingHandler);
            self::$logger->pushHandler(new StreamHandler('php://stdout'));
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
     * @param array $context
     * @return void
     */
    private static function logMessage(int $level, string $message, array $context = []): void
    {
        self::getLogger()->log($level, $message, $context);
    }

    // Define methods for logging messages with various log levels

    /**
     * Log Warning Message
     *
     * Logs a warning message.
     *
     * @param string $message The warning message to be logged
     * @param array $context
     * @return void
     */
    public static function warning(string $message, array $context = []): void
    {
        self::logMessage(300, $message, $context);
    }

    /**
     * Log Info Message
     *
     * Logs an informational message.
     *
     * @param string $message The informational message to be logged
     * @param array $context
     * @return void
     */
    public static function info(string $message, array $context = []): void
    {
        self::logMessage(200, $message, $context);
    }

    /**
     * Log Error Message
     *
     * Logs an error message.
     *
     * @param string $message The error message to be logged
     * @param array $context
     * @return void
     */
    public static function error(string $message, array $context = []): void
    {
        self::logMessage(400, $message, $context);
    }

    /**
     * Log Debug Message
     *
     * Logs a debug message.
     *
     * @param string $message The debug message to be logged
     * @param array $context
     * @return void
     */
    public static function debug(string $message, array $context = []): void
    {
        self::logMessage(100, $message, $context);
    }

    /**
     * Log Critical Message
     *
     * Logs a critical message.
     *
     * @param string $message The critical message to be logged
     * @param array $context
     * @return void
     */
    public static function critical(string $message, array $context = []): void
    {
        self::logMessage(500, $message, $context);
    }

    /**
     * Log Alert Message
     *
     * Logs an alert message.
     *
     * @param string $message The alert message to be logged
     * @param array $context
     * @return void
     */
    public static function alert(string $message, array $context = []): void
    {
        self::logMessage(550, $message, $context);
    }

    /**
     * Log Emergency Message
     *
     * Logs an emergency message.
     *
     * @param string $message The emergency message to be logged
     * @param array $context
     * @return void
     */
    public static function emergency(string $message, array $context = []): void
    {
        self::logMessage(600, $message, $context);
    }

    /**
     * Log Notice Message
     *
     * Logs a notice message.
     *
     * @param string $message The notice message to be logged
     * @param array $context
     * @return void
     */
    public static function notice(string $message, array $context = []): void
    {
        self::logMessage(250, $message, $context);
    }
}
