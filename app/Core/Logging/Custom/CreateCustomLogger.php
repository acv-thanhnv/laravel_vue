<?php

namespace App\Core\Logging\Custom;

use Monolog\Handler\LogEntriesHandler;
use Monolog\Logger;

class CreateCustomLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('Log');
        $logger->pushHandler(new CustomLoggerHandler($config));

        return $logger;
    }


}
