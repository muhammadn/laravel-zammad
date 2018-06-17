<?php

namespace Muhammadn\LaravelZammad;

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

class Zammad
{
    private $username;
    private $password;
    private $url;

    protected $tickets;
    protected $ticket;
    protected $users;
    protected $user;
    protected $organizations;
    protected $organization;
    protected $search;

    public function __construct()
    {
        $this->username = env('ZAMMAD_USERNAME');
        $this->password = env('ZAMMAD_PASSWORD');
	$this->url      = env('ZAMMAD_URL');
        $this->onBehalf = env('ZAMMAD_ON_BEHALF_USER');
	$this->debug    = env('ZAMMAD_DEBUG');
	$this->timeout  = env('ZAMMAD_TIMEOUT');
    }

    protected function client(){
        $client = new Client([
            'url'           => $this->url,  // URL to your Zammad installation
            'username'      => $this->username,  // Username to use for authentication
            'password'      => $this->password,           // Password to use for authentication
        ]);

	if (!empty($this->onBehalf))
        {
            $client->setOnBehalfOfUser($this->onBehalf);
        }

	if ($this->debug === 'true') 
        {
            $client->debug = true;
        }

	if (!empty($this->timeout) && is_integer($this->timeout))
        {
            $client->timeout = (integer) $this->timeout;
        }
        return $client;
    }

    // ticket functions
    public function searchTickets($string, $page = null, $objects_per_page = null)
    {
        $search = $this->client()->resource(ResourceType::TICKET)->search($string, $page, $objects_per_page);

        if ($search)
            return $search;

        if (empty($search))
        {
            return [];
	}

        return false;
    }

    public function allTickets($page = null, $objects_per_page = null)
    {
        $tickets = $this->tickets = $this->client()->resource(ResourceType::TICKET)->all($page, $objects_per_page);

        if ($this->tickets)
            return $this->tickets;

        if ($tickets->hasError())
        {
            return $tickets->getError();
        }

        return false;
    }

    public function createTicket($array)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET);
	foreach($array as $key => $value){
            $ticket->setValue($key, $value);
        }

	$ticket->save();

        if ($ticket->hasError())
        {
            return $ticket->getError();
        }
    }

    public function findTicket($id)
    {
        $ticket = $this->ticket =  $this->client()->resource(ResourceType::TICKET)->get($id);

        if ($this->ticket)
            return $this->ticket;

        if ($ticket->hasError())
        {
            return $ticket->getError();
        }

        return false;
    }

    public function updateTicket($id, $array)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->get($id);
        foreach($array as $key => $value){
            $ticket->setValue($key, $value);
	}

        $ticket->save();

	if ($ticket)
            return $ticket;

        if ($ticket->hasError())
        {
            return $ticket->getError();
        }
    }

    public function deleteTicket($id)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->get($id);
        $ticket->delete();
    }

    // user functions
    public function searchUsers($string, $page = null, $objects_per_page = null)
    {
        $search = $this->client()->resource(ResourceType::USER)->search($string, $page, $objects_per_page);

        if ($search)
            return $search;

        if (empty($search))
        {
            return [];
        }

        return false;
    }

    public function allUsers($page = null, $objects_per_page = null)
    {
        $users = $this->users = $this->client()->resource(ResourceType::USER)->all($page, $objects_per_page);

        if ($this->users)
            return $this->users;

        if ($users->hasError())
        {
            return $users->getError();
        }

        return false;
    }

    public function createUser($array)
    {
        $user = $this->client()->resource(ResourceType::USER);
        foreach($array as $key => $value){
            $user->setValue($key, $value);
        }

        $user->save();

        if ($user->hasError())
        {
            return $user->getError();
        }
    }

    public function findUser($id)
    {
        $user = $this->user =  $this->client()->resource(ResourceType::USER)->get($id);

        if ($this->user)
            return $this->user;

        if ($user->hasError())
        {
            return $user->getError();
        }

        return false;
    }

    public function updateUser($id, $array)
    {
        $user = $this->client()->resource(ResourceType::USER)->get($id);
        foreach($array as $key => $value){
            $user->setValue($key, $value);
        }

        $user->save();

        if ($user)
            return $user;

        if ($user->hasError())
        {
            return $user->getError();
        }
    }

    public function deleteUser($id)
    {
        $user = $this->client()->resource(ResourceType::USER)->get($id);
        $user->delete();
    }

    // organization functions
    public function searchOrganizations($string, $page = null, $objects_per_page = null)
    {
        $search = $this->client()->resource(ResourceType::ORGANIZATION)->search($string, $page, $objects_per_page);

        if ($search)
            return $search;

	if (empty($search))
        {
            return [];
        }

        return false;
    }

    public function allOrganizations($page = null, $objects_per_page = null)
    {
        $organizations = $this->organizations = $this->client()->resource(ResourceType::ORGANIZATION)->all($page, $objects_per_page);

        if ($this->organizations)
            return $this->organizations;

        if ($users->hasError())
        {
            return $users->getError();
        }

        return false;
    }

    public function findOrganization($id)
    {
        $organization = $this->organization =  $this->client()->resource(ResourceType::ORGANIZATION)->get($id);

        if ($this->organization)
            return $this->organization;

        if ($organization->hasError())
        {
            return $organization->getError();
        }

        return false;
    }

    public function updateOrganization($id, $array)
    {
        $organization = $this->client()->resource(ResourceType::ORGANIZATION)->get($id);
        foreach($array as $key => $value){
            $organization->setValue($key, $value);
        }

        $organization->save();

        if ($organization)
            return $organization;

        if ($organization->hasError())
        {
            return $organization->getError();
        }
    }

    public function deleteOrganization($id)
    {
        $organization = $this->client()->resource(ResourceType::ORGANIZATION)->get($id);
        $organization->delete();
    }
}
