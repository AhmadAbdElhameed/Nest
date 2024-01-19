<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductQty implements ValidationRule
{

    private $manageStock;

    public function __construct($manageStock)
    {
        $this->manageStock = $manageStock;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->manageStock == '1' && empty($value)) {
            $fail('The :attribute field is required and must be greater than 0 when manage stock is enabled.');
        }

    }
}
