<?php
namespace App\Core;

class Csrf
{
    public static function token(): string
    {
        if (!Session::has('_csrf')) {
            Session::set('_csrf', bin2hex(random_bytes(32)));
        }
        return Session::get('_csrf');
    }

    public static function verify(?string $token): bool
    {
        return $token && hash_equals(Session::get('_csrf', ''), $token);
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_csrf" value="' . self::token() . '">';
    }
}