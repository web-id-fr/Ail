<?php

namespace Webid\Ail\Exceptions;

use Exception;

class ProviderModelException extends Exception
{
    /** @var string  */
    protected $message = 'Model not found.';
}
