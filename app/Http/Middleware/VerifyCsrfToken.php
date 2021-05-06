<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:8000/submit-quiz',
        'http://localhost:8000/set-choice-item',
        // 'http://localhost:8000/avatar-upload',
        'http://localhost:8000/add-boomark',
        'http://localhost:8000/remove-boomark',
        'http://localhost:8000/submit-quiz',
    ];
}
