<?php

namespace Ansr\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class Recipients extends AbstractRule
{
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (empty($input)) {
            return false;
        }

        $input = explode(',', $input);
        $rule  = new Recipient();

        foreach ($input as $item) {
            if (!$rule->validate($item)) {
                return false;
            }
        }

        return true;
    }
}