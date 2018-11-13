<?php

namespace App\Core\Logging\DatabaseLogs;

use Monolog\Logger;

class CreateDatabaseLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('log');
        $logger->pushHandler(new DatabaseLoggerHandler($config));

        return $logger;
    }


}
