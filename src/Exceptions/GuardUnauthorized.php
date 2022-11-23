<?php

namespace Webid\Ail\Exceptions;

use Exception;

class GuardUnauthorized extends Exception
{
    /** @var string */
    protected $message = 'Guard not authorized (not in config).';
}
