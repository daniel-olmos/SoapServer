<?php

ini_set('soap.wsdl_cache_enabled', false);

$client = new SoapClient('calculator.wsdl');

print_r($client->add($_GET['a'], $_GET['b']));

