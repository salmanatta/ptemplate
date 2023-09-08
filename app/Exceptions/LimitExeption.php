<?php


namespace App\Exceptions;

use Illuminate\Http\Exceptions\ThrottleRequestsException;

class LimitExeption extends ThrottleRequestsException
{

    public function __construct($message)
    {
        parent::__construct($message, null, [], '2021');
    }

    public function getHeaders(): array
    {
        return [];
    }
}
