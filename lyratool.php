<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Http\Kernel;

require_once __DIR__ . "/vendor/autoload.php";

$app = $application = Container::getInstance();
$application->singleton(Kernel::class);

return $app;