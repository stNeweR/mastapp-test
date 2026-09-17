<?php

use App\Exceptions\ReferralCodeNotFoundException;
use App\Exceptions\SelfReferralNotAllowedException;
use App\Http\Middleware\ResolveCurrentMaster;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Авторизация в тестовом проекте заглушена:
        // текущий мастер берётся из заголовка X-Master-Id.
        $middleware->api(prepend: [
            ResolveCurrentMaster::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            fn (ReferralCodeNotFoundException $e) => response()->json(['message' => $e->getMessage()], 404)
        );
        $exceptions->render(
            fn (SelfReferralNotAllowedException $e) => response()->json(['message' => $e->getMessage()], 422)
        );
    })->create();
