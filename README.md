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
# Sets on behalf f you want to use API _as another user_
# which is different than your ZAMMAD_USERNAME above
ZAMMAD_ON_BEHALF_USER='otheruser@user.com'
# Sets the debug mode
ZAMMAD_DEBUG="true"
# Sets the API client timeout to Zammad API
ZAMMAD_TIMEOUT="15"
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
Example code for tickets:
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
      $data = $zammad::findTicket(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value 
      $data->getValue('title');

      // get articles from ticket
      $ticket = $zammad::findTicket(34);
      $articles = $ticket->getTicketArticles();
      // get first article content
      $article_content = $articles[0]->getValues();

      // Search the data
      $data = $zammad::searchTickets('text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::searchTickets('text you want to search', 4, 50);

      // Add new ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::createTicket($ticket_values)

      // Update a ticket
      $ticket_values = ['title' => 'Test Ticket', 'owner_id' => 1]
      $data = $zammad::updateTicket($ticket_id, $ticket_values)

      // Delete a ticket
      $data = $zammad::deleteTicket($ticket_id)
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
      $data = $zammad::allUsers();
      // get all users with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allUsers(4, 50);

      // get user of specific id
      $data = $zammad::findUser(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Search the data
      $data = $zammad::searchUsers('text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::searchUsers('text you want to search', 4, 50);

      // Add new User
      $user_values = ['email' => 'user@user.com', 'owner_id' => 1]
      $data = $zammad::createUser($user_values)

      // Update a user
      $user_values = ['email' => 'user@user.com', 'owner_id' => 1]
      $data = $zammad::updateUser($user_id, $user_values)

      // Delete a user
      $data = $zammad::deleteUser($user_id)
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
      $data = $zammad::allGroups();
      // get all groups with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allGroups(4, 50);

      // get group of specific id
      $data = $zammad::findGroup(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new Group
      $group_values = ['name' => 'ZammadGroup']
      $data = $zammad::createGroup($group_values)

      // Update a group
      $group_values = ['name' => 'ZammadGroup2']
      $data = $zammad::updateGroup($group_id, $group_values)

      // Delete a group
      $data = $zammad::deleteGroup($group_id)
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
      $data = $zammad::allTicketStates();
      // get all ticket states with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allTicketStates(4, 50);

      // get ticket state of specific id
      $data = $zammad::findTicketState(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new ticket state
      $state_values = ['name' => 'delayed', 'active' => true]
      $data = $zammad::createTicketState($state_values)

      // Update a ticket state
      $state_values = ['name' => 'boarding', 'active' => true]
      $data = $zammad::updateTicketState($state_id, $state_values)

      // Delete a ticket state
      $data = $zammad::deleteTicketState($state_id)
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
      $data = $zammad::allTicketPrioritiess();
      // get all ticket states with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allTicketPrioritiess(4, 50);

      // get ticket priority of specific id
      $data = $zammad::findTicketPriority(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add new ticket priority
      $priority_values = ['name' => '4 urgent', 'active' => true]
      $data = $zammad::createTicketPriority($priority_values)

      // Update a ticket priority
      $priority_values = ['name' => '5 very very urgent', 'active' => true]
      $data = $zammad::updateTicketPriority($priority_id, $priority_values)

      // Delete a ticket state
      $data = $zammad::deleteTicketPriority($priority_id)
    }
}
```

Example code for ticket articles:
```php
  public function index(LaravelZammad $zammad)
  {
      // get ticket article of specific id
      $data = $zammad::findTicketArticle(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Add ticket article
      $ticket_article_values = ['ticket_id' => 1, 'type_id' => 5, 'sender_id' => 2]
      $data = $zammad::createTicketArticle($ticket_article_values)

      // Update a ticket article
      $ticket_article_values = ['ticket_id' => 2, 'type_id' => 3, 'sender_id' => 7]
      $data = $zammad::updateTicketArticle($ticket_article_id, $ticket_article_values)

      // Delete a ticket article
      $data = $zammad::deleteTicketArticle($ticket_article_id)

```

Example code for Organizations:
```php
use LaravelZammad;

class MyController extends Controller
{

  public function index(LaravelZammad $zammad)
  {
      // get all organizations
      $data = $zammad::allOrganizations();
      // get all organizations with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::allOrganizations(4, 50);

      // get organization of specific id
      $data = $zammad::findOrganization(34);

      // To view the data (all values)
      $data->getValues();

      // Get single value
      $data->getValue('title');

      // Search the data
      $data = $zammad::searchOrganizations('text that you want to search')
      // get search results with pagination
      // example below for page 4, 50 entries at a time.
      $data = $zammad::searchOrganizations('text you want to search', 4, 50);

      // Add organization
      $organization_values = ['name' => 'Zammad', 'active' => true]
      $data = $zammad::createOrganization($organization_values)

      // Update an organization
      $organization_values = ['name' => 'Zammad', 'active' => true]
      $data = $zammad::updateOrganization($organization_id, $organization_values)

      // Delete an organization
      $data = $zammad::deleteOrganization($organization_id)
    }
}
```
