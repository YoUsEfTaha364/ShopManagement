<?php

use App\Http\Middleware\admin_auth;
use App\Http\Middleware\auth;
use App\Http\Middleware\auth_middleware;
use App\Http\Middleware\guest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(["auth"=>auth_middleware::class,"admin_auth"=>admin_auth::class,"guest"=>guest::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
