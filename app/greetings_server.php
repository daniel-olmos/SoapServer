<?php

require_once 'vendor/autoload.php';

class GreetingsServer
{
    function sayHello(string $name): string
    {
        return "Hello $name!";
    }

    function sayGoodBye(string $name): string
    {
        return "Goodbye $name!";
    }
}

if (array_key_exists('wsdl', $_GET)) {
    die(
    (new Laminas\Soap\AutoDiscover())
        ->setClass(GreetingsServer::class)
        ->setUri('https://leewayweb.com/soap/server')
        ->setServiceName('Greetings')
        ->generate()
        ->toXml()
    );
}

$server = new SoapServer();

$server->setClass(GreetingsServer::class);
$server->handle();
