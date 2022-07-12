<?php

const SERVER_URI = 'http://localhost:8000/greetings_server.php';
require_once 'vendor/autoload.php';

use Laminas\Soap\AutoDiscover;

class GreetingsServer
{
    /**
     * @param string $name
     * @return string
     */
    function sayHello(string $name): string
    {
        return "Hello $name!";
    }

    /**
     * @param string $name
     * @return string
     */
    public function sayGoodBye(string $name): string
    {
        return "Goodbye $name!";
    }
}

$wsdl = (new AutoDiscover())
    ->setClass(GreetingsServer::class)
    ->setUri(SERVER_URI)
    ->setServiceName('Greetings')
    ->setOperationBodyStyle([
        'use' => 'literal'
    ])
    ->setBindingStyle(
        [
            'style' => 'rpc'
        ])
    ->generate()
    ->toXml();

$wsdlfile = tempnam(sys_get_temp_dir(), __FILE__);
file_put_contents($wsdlfile, $wsdl);

if (array_key_exists('wsdl', $_GET)) {
    header('Content-Type: application/wsdl+xml');
    die($wsdl);
}

$server = new SoapServer($wsdlfile, [
    'soap_version' => SOAP_1_2,
]);
$server->setClass(GreetingsServer::class);
$server->handle();
