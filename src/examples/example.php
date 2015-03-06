<?php

require_once __DIR__.'/../../vendor/autoload.php';

$cmsi = new Arall\CMSIdentifier(isset($argv[1]) ? $argv[1] : 'http://joomla.org/');

print_r($cmsi->getResults());
