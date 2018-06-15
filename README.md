# zammad-laravel
Laravel wrapper around the official Zammad PHP API Library

This wrapper depends on the official [Zammad PHP Client](https://github.com/zammad/zammad-api-client-php)

## Installation

### Requirements
The API client needs [composer](https://getcomposer.org/). For installation have a look at its [documentation](https://getcomposer.org/download/).
Additionally, the API client needs PHP 5.6 or newer.

### Integration into your project
Run the following command within the root folder of your laravel project to install the wrapper:
```
composer require muhammadn/zammad-laravel
```

### Add Zammad credentials for your Laravel installation
Edit your .env file and add your username, password and url of your zammad installation
```
ZAMMAD_USERNAME='your_zammad_email'
ZAMMAD_PASSWORD='zammad_password'
ZAMMAD_URL='https://your-zammad-instance'
```

## How to use this wrapper
Example code:
```php

use ZammadAPIClient\ResourceType; 

class MyController {

 $client = App::make('zammad.client');
 $ticket = $client->resource( ResourceType::TICKET )->get(34);


}
```
