<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // code 419 因為php session 預設維持24分鐘，過期 以method="DELEDT"的logout 也會噴419 ，把logout 不要受csrf的保護
        '/logout',
    ];
}
