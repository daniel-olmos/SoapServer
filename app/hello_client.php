<?php

ini_set('soap.wsdl_cache_enabled', false);

$client = new SoapClient('hello.wsdl');

echo $client->sayHello($_GET['name']);

