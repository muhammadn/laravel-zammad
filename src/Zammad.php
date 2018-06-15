<?php

namespace Muhammadn\ZammadLaravel;

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

class Zammad extends ResourceType
{
    private $username;
    private $password;
    private $url;

    protected $ticket;
    protected $search;

    public function __construct()
    {
        $this->username = env('ZAMMAD_USERNAME');
        $this->password = env('ZAMMAD_PASSWORD');
	$this->url      = env('ZAMMAD_URL');
    }

    protected function client(){
        $client = new Client([
            'url'           => env('ZAMMAD_URL'), // URL to your Zammad installation
            'username'      => env('ZAMMAD_USERNAME'),  // Username to use for authentication
            'password'      => env('ZAMMAD_PASSWORD'),           // Password to use for authentication
        ]);

        return $client;
    }

    public function getTickets()
    {
        $tickets = $this->client()->resource(ResourceType::TICKET)->all();

        if ($tickets)
            return $tickets;

        if ($tickets->hasError())
        {
            return $tickets->getError();
        }

        return false;
    }

    public function getTicket($id)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->get($id);

	if ($ticket)
            return $ticket;

        if ($ticket->hasError())
        {
            return $ticket->getError();
        }

        return false;
    }

    public function deleteTicket($id)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->delete($id);

        if ($ticket)
            return $ticket;

        if ($ticket->hasError())
        {
            return $ticket->getError();
        }

        return false;
    }

    public function searchTicket($string)
    {
        $search = $this->client()->resource(ResourceType::TICKET)->search($string);

        if ($search)
            return $search;

	if ($search->hasError())
        {
            return $search->getError();
        }

	return false;
    }

    public function createTicket()
    {
        $ticket = $client->resource(ResourceType::TICKET);
        $ticket->setValue('title', 'My new ticket');
	$ticket->save();
    }

    public function updateTicket($id)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->get($id);
        $ticket->setValue('title', 'My second new ticket');
        $ticket->save();
    }

}
