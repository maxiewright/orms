<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class RequireIfTrue  implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        // $fail('This rule failed');
    }
}
