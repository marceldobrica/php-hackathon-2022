<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';
/**
 * Set default timezone for where complex is... the server might be in other location....
 */
date_default_timezone_set( 'Europe/Bucharest' );
return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
