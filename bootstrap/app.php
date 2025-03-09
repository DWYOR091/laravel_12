<?php

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //append buat global
        // $middleware->append(EnsureTokenIsValid::class);
        //alias 
        $middleware->alias(['tokenValid' => EnsureTokenIsValid::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
