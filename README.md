# LOKI

## Usage

### Laravel

/config/logging.php

```php

use Lmsomeco\Loki\LokiLogger;

...

'channels' => [
    ...
    'loki' => [
        'driver' => 'custom',
        'via' => LokiLogger::class,
        'data' => [
            'url' => 'https://examplelogger.com/api/endpoint',
            'token' => '12345678901234567'
        ]
    ]
]

```

### Wordpress

Link to wordpress plugin goes here.
