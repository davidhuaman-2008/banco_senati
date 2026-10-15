<?php
namespace App\Core;

class Validator
{
    public static function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            $rulesArr = explode('|', $ruleSet);
            $value = trim((string)($data[$field] ?? ''));
            foreach ($rulesArr as $rule) {
                [$name, $param] = array_pad(explode(':', $rule, 2), 2, null);
                $ok = match ($name) {
                    'required' => $value !== '',
                    'numeric'  => is_numeric($value),
                    'min'      => strlen($value) >= (int)$param,
                    'max'      => strlen($value) <= (int)$param,
                    'email'    => filter_var($value, FILTER_VALIDATE_EMAIL) !== false,
                    'date'     => strtotime($value) !== false,
                    default    => true,
                };
                if (!$ok) $errors[$field][] = "Falla regla: $name";
            }
        }
        return $errors;
    }
}