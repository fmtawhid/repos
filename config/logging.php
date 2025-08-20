<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
            'replace_placeholders' => true,
        ],

        'slowQueries'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/slowQueries/slowQueries.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],


        'failedResponseLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/failedResponseLog/failedResponseLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'seoLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/seoLog/seoLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],

        'userBalanceLog'=>[
            'driver' => 'daily',
            'path'   => storage_path('logs/userBalanceLog/userBalanceLog.log'),
            'level'  => 'info',
            'days'   => 1000,
            'permission' => 0777,
        ],

        'openAiLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/openAiLog/openAiLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'stableDiffusion'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/stableDiffusion/stableDiffusion.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'elevenLabLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/elevenLabLog/elevenLabLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'azureLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/azureLog/azureLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'googleLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/googleLog/googleLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'geminiLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/geminiLog/geminiLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'validationErrorLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/validationErrorLog/validationErrorLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'syntaxErrorLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/syntaxErrorLog/syntaxErrorLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'systemSettingLog'=>[
            'driver' => 'daily',
            'path' => storage_path('logs/systemSettingLog/systemSettingLog.log'),
            'level' => 'info',
            'days' => 1000,
            'permission' => 0777,
        ],

        'ticketLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/ticketLog/ticketLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],

        'promptLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/promptLog/promptLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],

        'paypalLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/paypalLog/paypalLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],

        'stripeLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/stripeLog/stripeLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],

        'falseResponseLog'=>[
            'driver'     => 'daily',
            'path'       => storage_path('logs/falseResponseLog/falseResponseLog.log'),
            'level'      => 'info',
            'days'       => 1000,
            'permission' => 0777,
        ],


        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => LOG_USER,
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
    ],

];
