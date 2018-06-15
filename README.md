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
Edit your .env file (at the root folder of your laravel project) and add your username, password and url of your zammad installation
```
ZAMMAD_USERNAME='your_zammad_email'
ZAMMAD_PASSWORD='zammad_password'
ZAMMAD_URL='https://your-zammad-instance'
```

### Configure your laravel providers to use this wrapper
Edit config/app.php and add:
```php
    'providers' => [
        .... all the other providers ....
        Muhammadn\ZammadLaravel\ZammadServiceProvider::class,
    ],
```      
## How to use this wrapper
Example code:
```php

use ZammadAPIClient\ResourceType; 

class MyController extends Controller
{

  $zammad = App::make('zammad');

  // get all tickets
  $data = $zammad->getTickets()

  // get ticket of specific id
  $data = $zammad->getTickets(34)

  // To view the data
  $data->getValues()

  // Search the data
  $data = $zammad->search('text that you want to search')

  // Add new ticket
  $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
  $data = $zammad->createTicket($ticket_values)

  // Update a new ticket
  $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
  $data = $zammad->updateTicket($ticket_id, $ticket_values)

  // Delete a ticket
  $data = $zammad->deleteTicket($ticket_id)
}
```
