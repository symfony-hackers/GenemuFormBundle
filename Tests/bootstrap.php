<?php

/*
 * This file is part of the SHFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!@$loader = include __DIR__.'/../vendor/autoload.php') {
    throw new RuntimeException('Install dependencies to run test suite.');
}

error_reporting(E_ALL);

