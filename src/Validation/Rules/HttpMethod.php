<?php

namespace Ansr\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class HttpMethod extends AbstractRule
{
    public function validate($input): bool
    {
        return in_array($input, ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH']);
    }
}