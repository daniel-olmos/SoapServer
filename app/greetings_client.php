<?php

ini_set('soap.wsdl_cache_enabled', false);

$client = new SoapClient('grettings.wsdl');

echo $client->sayHello($_GET['name']);

