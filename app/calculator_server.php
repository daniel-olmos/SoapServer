<?php

$soapServer = new SoapServer('calculator.wsdl');
$soapServer->addFunction(
    [
        'add',
        'subtract',
    ]
);

$soapServer->handle();
function add(int $a, int $b) : int
{
    return $a + $b;
}

function subtract(int $a, int $b): int
{
    return $a - $b;
}