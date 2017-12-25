<?php

if (!@$loader = include __DIR__.'/../vendor/autoload.php') {
    throw new RuntimeException('Install dependencies to run test suite.');
}

error_reporting(E_ALL);
