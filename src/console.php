<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application; 
use BartoszFabianski\Core\Command\CsvSimpleCommand;
use BartoszFabianski\Core\Command\CsvExtendedCommand;

$app = new Application();

$app->add(new CsvSimpleCommand());
$app->add(new CsvExtendedCommand());

$app->run();