<?php

namespace Muhammadn\LaravelZammad;

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

class Zammad
{
    private $username;
    private $password;
    private $url;

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

	if (!empty($this->timeout))
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

    // groups
    public function allGroups($page = null, $objects_per_page = null)
    {
        $groups = $this->groups = $this->client()->resource(ResourceType::GROUP)->all($page, $objects_per_page);

        if ($this->groups)
            return $this->groups;

        if ($groups->hasError())
        {
            return $groups->getError();
        }

        return false;
    }

    public function createGroup($array)
    {
        $group = $this->client()->resource(ResourceType::GROUP);
        foreach($array as $key => $value){
            $group->setValue($key, $value);
        }

        $group->save();

        if ($group->hasError())
        {
            return $group->getError();
        }
    }


    public function findGroup($id)
    {
        $group = $this->group =  $this->client()->resource(ResourceType::GROUP)->get($id);

        if ($this->group)
            return $this->group;

        if ($group->hasError())
        {
            return $group->getError();
        }

        return false;
    }

    public function updateGroup($id, $array)
    {
        $group = $this->client()->resource(ResourceType::GROUP)->get($id);
        foreach($array as $key => $value){
            $group->setValue($key, $value);
        }

        $group->save();

        if ($group)
            return $group;

        if ($group->hasError())
        {
            return $group->getError();
        }
    }

    public function deleteGroup($id)
    {
        $group = $this->client()->resource(ResourceType::GROUP)->get($id);
        $group->delete();
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

        if ($organizations->hasError())
        {
            return $organizations->getError();
        }

        return false;
    }

    public function createOrganization($array)
    {
        $organization = $this->client()->resource(ResourceType::ORGANIZATION);
        foreach($array as $key => $value){
            $organization->setValue($key, $value);
        }

        $organization->save();

        if ($organization->hasError())
        {
            return $organization->getError();
        }
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

    // ticket articles
    public function createTicketArticle($array)
    {
        $ticketArticle = $this->client()->resource(ResourceType::TICKET_ARTICLE);
        foreach($array as $key => $value){
            $ticketArticle->setValue($key, $value);
        }

        $ticketArticle->save();

        if ($ticketArticle->hasError())
        {
            return $ticketArticle->getError();
        }
    }

    public function findTicketArticle($id)
    {
        $ticket_article = $this->ticket_article = $this->client()->resource(ResourceType::TICKET_ARTICLE)->get($id);

        if ($this->ticket_article)
            return $this->ticket_article;

        if ($ticket_article->hasError())
        {
            return $ticket_article->getError();
        }

        return false;
    }

    public function updateTicketArticle($id, $array)
    {
        $ticketArticle = $this->client()->resource(ResourceType::TICKET_ARTICLE)->get($id);
        foreach($array as $key => $value){
            $ticketArticle->setValue($key, $value);
        }

        $ticketArticle->save();

        if ($ticketArticle)
            return $ticketArticle;

        if ($ticketArticle->hasError())
        {
            return $ticketArticle->getError();
        }
    }

    public function deleteTicketArticle($id)
    {
        $ticketArticle = $this->client()->resource(ResourceType::TICKET_ARTICLE)->get($id);
        $ticketArticle->delete();
    }

    // ticket state
    public function allTicketStates($page = null, $objects_per_page = null)
    {
        $states = $this->states = $this->client()->resource(ResourceType::TICKET_STATE)->all($page, $objects_per_page);

        if ($this->states)
            return $this->states;

        if ($states->hasError())
        {
            return $states->getError();
        }

        return false;
    }

    public function createTicketState($array)
    {
        $ticketState = $this->client()->resource(ResourceType::TICKET_STATE);
        foreach($array as $key => $value){
            $ticketState->setValue($key, $value);
        }

        $ticketState->save();

        if ($ticketState->hasError())
        {
            return $ticketState->getError();
        }
    }

    public function findTicketState($id)
    {
        $state = $this->state = $this->client()->resource(ResourceType::TICKET_STATE)->get($id);

        if ($this->state)
            return $this->state;

        if ($state->hasError())
        {
            return $state->getError();
        }

        return false;
    }

    public function updateTicketState($id, $array)
    {
        $ticketState = $this->client()->resource(ResourceType::TICKET_STATE)->get($id);
        foreach($array as $key => $value){
            $ticketState->setValue($key, $value);
        }

        $ticketState->save();

        if ($ticketState)
            return $ticketState;

        if ($ticketState->hasError())
        {
            return $ticketState->getError();
        }
    }

    public function deleteTicketState($id)
    {
        $ticketState = $this->client()->resource(ResourceType::TICKET_STATE)->get($id);
        $ticketState->delete();
    }

    // ticket priority
    public function allTicketPriorities($page = null, $objects_per_page = null)
    {
        $priorities = $this->priorities = $this->client()->resource(ResourceType::TICKET_PRIORITY)->all($page, $objects_per_page);

        if ($this->priorities)
            return $this->priorities;

        if ($priorities->hasError())
        {
            return $priorities->getError();
        }

        return false;
    }

    public function createTicketPriority($array)
    {
        $ticketPriority = $this->client()->resource(ResourceType::TICKET_PRIORITY);
        foreach($array as $key => $value){
            $ticketPriority->setValue($key, $value);
        }

        $ticketPriority->save();

        if ($ticketPriority->hasError())
        {
            return $ticketPriority->getError();
        }
    }

    public function findTicketPriority($id)
    {
        $priority = $this->priority= $this->client()->resource(ResourceType::TICKET_PRIORITY)->get($id);

        if ($this->priority)
            return $this->priority;

        if ($priority->hasError())
        {
            return $priority->getError();
        }

        return false;
    }

    public function updateTicketPriority($id, $array)
    {
        $ticketPriority = $this->client()->resource(ResourceType::TICKET_PRIORITY)->get($id);
        foreach($array as $key => $value){
            $ticketPriority->setValue($key, $value);
        }

        $ticketPriority->save();

        if ($ticketPriority)
            return $ticketPriority;

        if ($ticketPriority->hasError())
        {
            return $ticketPriority->getError();
        }
    }

    public function deleteTicketPriority($id)
    {
        $ticketPriority = $this->client()->resource(ResourceType::TICKET_PRIORITY)->get($id);
        $ticketPriority->delete();
    }
}
