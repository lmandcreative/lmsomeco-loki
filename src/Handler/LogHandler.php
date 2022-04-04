<?php

namespace Lmsomeco\Loki\Handler;

use Monolog\Logger;
use Monolog\Handler\Curl\Util;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\AbstractProcessingHandler;

class LogHandler extends AbstractProcessingHandler implements HandlerInterface
{
    public function __construct(
        private string $url,
        private string $token,
        private array $headers = [],
        $level = Logger::DEBUG,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {

        $headers = array('Content-type: application/json', 'Authorization: Bearer ' . $this->token);
        $headers = array_merge([$headers, $this->headers]);

        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $this->url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($record)
        );

        curl_setopt_array($ch, $options);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        Util::execute($ch);
    }
}
