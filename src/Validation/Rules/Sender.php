<?php

namespace Ansr\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class Sender extends AbstractRule
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (strlen($input) < 4) {
            return false;
        }

        $max = is_numeric($input) ? 14 : 11;

        if (strlen($input) > $max) {
            return false;
        }

        return true;
    }
}