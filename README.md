# PHP Curl client

## install

```bash
composer require jblond/phpcurl
```

## example

```php
<?php

use jblond\phpcurl\Client;
use jblond\phpcurl\Decoder;

require './vendor/autoload.php';

$client = new Client();
$decoder = new Decoder();
$response = $client->get('https://example.com/some.json');
$content = $decoder->jsonToArray($response);
print_r($content);
```
