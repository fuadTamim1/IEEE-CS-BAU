<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedRegistrationDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = strtolower(trim((string) $value));
        $allowedDomains = $this->allowedDomains();

        if ($allowedDomains === []) {
            return;
        }

        $atPosition = strrpos($email, '@');
        if ($atPosition === false) {
            $fail('The :attribute must be a valid email address.');

            return;
        }

        $domain = substr($email, $atPosition + 1);

        if (in_array($domain, $allowedDomains, true)) {
            return;
        }

        $fail('Registration is currently limited to these domains: ' . implode(', ', $allowedDomains) . '.');
    }

    /**
     * @return list<string>
     */
    private function allowedDomains(): array
    {
        $raw = (string) get_setting('allowed_domains_for_registration', '');

        if (trim($raw) === '') {
            return [];
        }

        $domains = [];

        foreach (explode(',', $raw) as $candidate) {
            $normalized = strtolower(trim($candidate));

            if ($normalized === '') {
                continue;
            }

            if (str_starts_with($normalized, '@')) {
                $normalized = substr($normalized, 1);
            }

            if ($normalized === '') {
                continue;
            }

            $domains[] = $normalized;
        }

        return array_values(array_unique($domains));
    }
}
