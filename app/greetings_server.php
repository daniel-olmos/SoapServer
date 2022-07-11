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
    $autodiscover = new Laminas\Soap\AutoDiscover();
    $autodiscover
        ->setClass(GreetingsServer::class)
        ->setUri('https://leewayweb.com/soap/server')
        ->setServiceName('Greetings');

    die($autodiscover->generate()->toXml());
}

$server = new SoapServer();

$server->setClass(GreetingsServer::class);
$server->handle();
