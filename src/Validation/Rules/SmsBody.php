<?php

namespace Ansr\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class SmsBody extends AbstractRule
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (strlen($input) > 160) {
            return false;
        }

        return true;
    }
}