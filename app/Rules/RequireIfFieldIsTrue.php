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
        protected string $field,
        protected ?string $fieldName = null
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->data[$this->field] && ! $value) {
            $fail("this field is required if {$this->fieldName()} field is true");
        }
    }

    private function fieldName(): string
    {
        return (! $this->fieldName)
            ? Str::lower(Str::replace('_', ' ', $this->field))
            : $this->fieldName;
    }

    public function setData(array $data): RequireIfFieldIsTrue|static
    {
        $this->data = $data['data'];

        return $this;
    }
}
