PHP Rest Client
===
Simple cURL PHP Rest Client library for PHP 5.3+

### Feature
---
* Set `HTTP Authentication`
* Set `HTTP Header`
* `GET`, `POST`, `PUT`, `DELETE` Method

### Installation
---
This library can installed through [compose](http://getcomposer.org/)

```
$ php composer.phar require jowy/rest-client:@stable
```

### Usage
---

```php
<?php

use RestClient\CurlRestClient;

$curl = new CurlRestClient();

var_dump($curl->executeQuery('http://www.google.com'));
```

### Parameter
---

* `url`describe target url
* `method` define HTTP method can be `GET`, `POST`, `PUT`, `DELETE`. Default value is `DELETE`
* `header` contain array list of header
* `data` contain array list of data
* `auth` contain array list of auth

Example fullset usage

```php
$curl->executeQuery('http://api.somewebsite.com',
    'POST',
    array(
        'X-API-KEY: 16251821972',
        'OUTPUT: JSON'
    ),
    array(
        'USERNAME' => 'jowy',
        'SERVERID'  => '192882'
    ),
    array(
        'CURLOPT_HTTPAUTH' => CURL_AUTH_DIGEST,
        'username'  =>  'jowy',
        'password'  =>  '123456'
    )
);
```