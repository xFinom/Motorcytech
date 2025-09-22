<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RfcValid implements ValidationRule
{
    private string $pattern = '/^([A-ZÑ]|\&){3,4}[0-9]{2}(0[1-9]|1[0-2])([12][0-9]|0[1-9]|3[01])[A-Z0-9]{3}$/';

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $unwanted_array = [' ' => '', '-' => '', '_' => ''];

        /** @var string $value */
        $rfc = strtoupper(strtr($value, $unwanted_array));

        if (! preg_match($this->pattern, $rfc)) {
            $fail('El RFC no es valido');
        }
    }
}
