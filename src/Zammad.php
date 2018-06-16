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
    protected $search;

    public function __construct()
    {
        $this->username = env('ZAMMAD_USERNAME');
        $this->password = env('ZAMMAD_PASSWORD');
	$this->url      = env('ZAMMAD_URL');
    }

    protected function client(){
        $client = new Client([
            'url'           => $this->url,  // URL to your Zammad installation
            'username'      => $this->username,  // Username to use for authentication
            'password'      => $this->password,           // Password to use for authentication
        ]);

        return $client;
    }

    public function getTickets()
    {
        $tickets = $this->tickets = $this->client()->resource(ResourceType::TICKET)->all();

        if ($this->tickets)
            return $this->tickets;

        if ($tickets->hasError())
        {
            return $tickets->getError();
        }

        return false;
    }

    public function getTicket($id)
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

    public function deleteTicket($id)
    {
        $ticket = $this->client()->resource(ResourceType::TICKET)->get($id);
        $ticket->delete();
    }

    public function search($string)
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

}
