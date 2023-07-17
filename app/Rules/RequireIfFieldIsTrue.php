<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class RequireIfFieldIsTrue implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function __construct(
        protected string $dependencyField,
        protected ?string $dependencyFieldName = null
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $dependencyValue = $this->data[$this->dependencyField];

        if ($dependencyValue !== $value) {
            $fail("this field is required if {$this->dependencyFieldName()} field is set");
        }

    }

    private function dependencyFieldName(): string
    {
        return (!$this->dependencyFieldName)
            ? Str::lower(Str::replace('_', ' ', $this->dependencyField))
            : $this->dependencyFieldName;

    }

    public function setData(array $data): RequireIfFieldIsTrue|static
    {
        $this->data = $data['data'];

        return $this;
    }
}
