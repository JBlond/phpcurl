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
$response = $client->get('http://localhost/test.json');
if( !is_array($response)){
    $content = $decoder->jsonToArray($response);
}
else
{
    $content = $response;
}
print_r($content);
print_r(
    $client->post(
        'http://localhost/post.php',
        json_encode(['lorem' => 'lol'])
    )
);
```
