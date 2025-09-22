<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotProfane implements ValidationRule
{
    protected $badWords = [
        'tonto', 'idiota', 'estupido', 'pendejo', 'puto',
        'mierda', 'pene', 'pitudo', 'chingar', 'cabrón', 'culero'
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->badWords as $word) {
            if (preg_match('/\b' . preg_quote($word, '/') . '\b/i', $value)) {
                $fail('validation.profane'); // clave personalizada
            }
        }
    }
}
