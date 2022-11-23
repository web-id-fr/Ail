<?php

namespace Webid\Ail\Exceptions;

use Exception;

class ProviderDriverException extends Exception
{
    /** @var string  */
    protected $message = 'Only eloquant provider supported';
}
