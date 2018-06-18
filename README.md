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
### Optional parameters
# Sets on behalf if you want to use API **as another user**
# which is different than your ZAMMAD_USERNAME above
ZAMMAD_ON_BEHALF_USER='otheruser@user.com'
# Sets the debug mode
ZAMMAD_DEBUG=true
# Sets the API client timeout to Zammad API
ZAMMAD_TIMEOUT=15
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
      $data = $zammad::all('ticket');
      // get all tickets with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('ticket', 4, 50);

      // get ticket of specific id
      $data = $zammad::find('ticket', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value 
      $data->getValue('title');

      // get articles from ticket
      $ticket = $zammad::find('ticket', 34);
      $articles = $ticket->getTicketArticles();
      // get first article content
      $article_content = $articles[0]->getValues();

      // Search the data
      $data = $zammad::search('ticket', 'text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::search('ticket', 'text you want to search', 4, 50);

      // Add new ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::create('ticket', $ticket_values)

      // Update a ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::update('ticket', $ticket_id, $ticket_values)

      // Delete a ticket
      $data = $zammad::delete('ticket', $ticket_id)
    }
}
```

Example code for users:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all users
      $data = $zammad::all('user');
      // get all users with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('user', 4, 50);

      // get user of specific id
      $data = $zammad::find('user', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Search the data
      $data = $zammad::search('user', 'text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::search('user', 'text you want to search', 4, 50);

      // Add new User
      $user_values = ['email' => 'user@user.com', 'owner_id' => 1]
      $data = $zammad::create('user', $user_values)

      // Update a user
      $user_values = ['email' => 'user@user.com', 'owner_id' => 1]
      $data = $zammad::update('user', $user_id, $user_values)

      // Delete a user
      $data = $zammad::delete('user', $user_id)
    }
}
```

Example code for groups:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all groups
      $data = $zammad::all('group');
      // get all groups with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('group', 4, 50);

      // get group of specific id
      $data = $zammad::find('group', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new Group
      $group_values = ['name' => 'ZammadGroup']
      $data = $zammad::create('group', $group_values)

      // Update a group
      $group_values = ['name' => 'ZammadGroup2']
      $data = $zammad::update('group', $group_id, $group_values)

      // Delete a group
      $data = $zammad::delete('group', $group_id)
    }
}
```

Example code for ticket state:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all ticket states
      $data = $zammad::all('ticket_state');
      // get all ticket states with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('ticket_state', 4, 50);

      // get ticket state of specific id
      $data = $zammad::find('ticket_state', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new ticket state
      $state_values = ['name' => 'delayed', 'active' => true]
      $data = $zammad::create('ticket_state', $state_values)

      // Update a ticket state
      $state_values = ['name' => 'boarding', 'active' => true]
      $data = $zammad::update('ticket_state;, $state_id, $state_values)

      // Delete a ticket state
      $data = $zammad::delete('ticket_state', $state_id)
    }
}
```

Example code for ticket priority:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all ticket priorities
      $data = $zammad::all('ticket_priority');
      // get all ticket states with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('ticket_prioriry', 4, 50);

      // get ticket priority of specific id
      $data = $zammad::find('ticket_priority', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new ticket priority
      $priority_values = ['name' => '4 urgent', 'active' => true]
      $data = $zammad::create('ticket_priority', $priority_values)

      // Update a ticket priority
      $priority_values = ['name' => '5 very very urgent', 'active' => true]
      $data = $zammad::update('ticket_priority', $priority_id, $priority_values)

      // Delete a ticket state
      $data = $zammad::delete('ticket_priority', $priority_id)
    }
}
```

Example code for ticket articles:
```php
  public function index(LaravelZammad $zammad)
  {
      // get ticket article of specific id
      $data = $zammad::find('ticket_article', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add ticket article
      $ticket_article_values = ['ticket_id' => 1, 'type_id' => 5, 'sender_id' => 2]
      $data = $zammad::create('ticket_article', $ticket_article_values)

      // Update a ticket article
      $ticket_article_values = ['ticket_id' => 2, 'type_id' => 3, 'sender_id' => 7]
      $data = $zammad::update('ticket_article', $ticket_article_id, $ticket_article_values)

      // Delete a ticket article
      $data = $zammad::delete('ticket_article', $ticket_article_id)

```

Example code for Organizations:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all organizations
      $data = $zammad::all('organization');
      // get all organizations with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::all('organization', 4, 50);

      // get organization of specific id
      $data = $zammad::find('organization', 34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Search the data
      $data = $zammad::search('organization', 'text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::search('organization', 'text you want to search', 4, 50);

      // Add organization
      $organization_values = ['name' => 'Zammad', 'active' => true]
      $data = $zammad::create('organization', $organization_values)

      // Update an organization
      $organization_values = ['name' => 'Zammad', 'active' => true]
      $data = $zammad::update('organization', $organization_id, $organization_values)

      // Delete an organization
      $data = $zammad::delete('organization', $organization_id)
    }
}
```
