# laravel-zammad
Laravel wrapper around the official Zammad PHP API Library

This wrapper depends on the official [Zammad PHP Client](https://github.com/zammad/zammad-api-client-php)

## Installation

### Requirements
The API client needs [composer](https://getcomposer.org/). For installation have a look at its [documentation](https://getcomposer.org/download/).
Additionally, the API client needs PHP 5.6 or newer.

### Integration into your project
Run the following command within the root folder of your laravel project to install the wrapper:
```
composer require muhammadn/laravel-zammad
```

### Add Zammad credentials for your Laravel installation
Edit your .env file (at the root folder of your laravel project) and add your username, password and url of your zammad installation
```
ZAMMAD_USERNAME='your_zammad_email'
ZAMMAD_PASSWORD='zammad_password'
ZAMMAD_URL='https://your-zammad-instance'
```

### Configure your laravel providers to use this wrapper
Edit config/app.php and add in providers section:
```php
    'providers' => [
        .... all the other providers ....
        Muhammadn\ZammadLaravel\ZammadServiceProvider::class,
    ],
```      

### Configure your laravel Facade to use this wrapper
Edit config/app.php and add in aliases section:
```php
    'aliases' => [
        ... all the other facades ...
        'LaravelZammad' => Muhammadn\ZammadLaravel\ZammadFacade::class,
    ]
```
## How to use this wrapper
Example code:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all tickets
      $data = $zammad::allTickets();
      // get all tickets with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allTickets(4, 50);

      // get ticket of specific id
      $data = $zammad::getTicket(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value 
      $data->getValue('title');

      // get articles from ticket
      $ticket = $zammad::getTickets(34);
      $articles = $ticket->getTicketArticles();
      // get first article content
      $article_content = $articles[0]->getValues();

      // Search the data
      $data = $zammad::search('text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::search('text you want to search', 4, 50);

      // Add new ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::createTicket($ticket_values)

      // Update a new ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::updateTicket($ticket_id, $ticket_values)

      // Delete a ticket
      $data = $zammad::deleteTicket($ticket_id)
    }
}
```
