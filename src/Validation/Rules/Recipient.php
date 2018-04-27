<?php

namespace Ansr\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class Recipient extends AbstractRule
{
    public function validate($input): bool
    {
        return
            is_numeric($input)
            && strpos($input, '00') !== 0
            && strpos($input, '+') !== 0
            && strlen($input) >= 10;
    }
}