<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
class UpdateUniqueAttributeName implements ValidationRule
{

    private $attributeId;

    public function __construct($attributeId = null)
    {
        $this->attributeId = $attributeId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Construct the query
        $query = DB::table('attribute_translations')->where('name', $value);

        // Exclude the current attribute from the check if $attributeId is provided
        if (!is_null($this->attributeId)) {
            $query->where('attribute_id', '!=', $this->attributeId);
        }

        // Check if the name exists
        if ($query->exists()) {
            $fail('The :attribute has already been taken.');
        }
    }
}
