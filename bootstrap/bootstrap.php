<?php

require_once __DIR__ . "/../vendor/autoload.php";

$app = \Illuminate\Container\Container::getInstance();
$app->singleton("console", \Lyratool\Console\Kernel::class);

return $app;