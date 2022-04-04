<?php

namespace Lmsomeco\Loki;

use Monolog\Logger;
use Lmsomeco\Loki\Handler\LogHandler;

class LokiLogger
{
    public function __invoke(array $config)
    {
        if (array_key_exists('data', $config)) {
            if (!array_key_exists('url', $config['data']) || !array_key_exists('token', $config['data'])) {
                error_log('LokiLogger config incomplete');
                return;
            }
            $headers = [];
            if (array_key_exists('headers', $config['data']) && !empty($config['data']['headers'])) {
                $headers = (array) $config['data']['headers'];
            }

            return new Logger('loki', [new LogHandler($config['data']['url'], $config['data']['token'], $headers)]);
        } else {
            error_log('data does not exist in LokiLogger config');
            return;
        }
    }
}
