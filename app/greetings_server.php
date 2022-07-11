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

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (array_key_exists('wsdl', $_GET)) {
    $wsdl = new WSDL\WSDLCreator(GreetingsServer::class, $currentURL);
    $wsdl->setNamespace($protocol.$_SERVER['HTTP_HOST']);

    die($wsdl->renderWSDL());
}
$server = new SoapServer(__DIR__.'/grettings.wsdl');

$server->setClass(GreetingsServer::class);
$server->handle();
