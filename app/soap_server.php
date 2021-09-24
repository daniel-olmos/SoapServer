<?php

class HelloServer
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

$server = new SoapServer(__DIR__.'/hello.wsdl');

$server->setClass(HelloServer::class);
$server->handle();
