<?php

require_once __DIR__ . "/bootstrap/bootstrap.php";

try {
    $app->make("console")->run();
} catch (\Illuminate\Contracts\Container\BindingResolutionException $e) {
    echo "¯\_(ツ)_/¯";
}