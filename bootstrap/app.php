<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Assegura't que aquesta línia existeix
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Força JSON a les rutes que comencen per 'api/*'
        $exceptions->shouldRenderJsonWhen(fn (Request $request) => $request->is('api/*'));

        // Gestió d'errors de validació (422)
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Dades no vàlides.',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        // Gestió d'errors d'autenticació (401)
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'No autenticat.'], 401);
            }
        });

        // Gestió de recurs no trobat (404)
        $exceptions->render(function (\Illuminate\Database\Eloquent\ModelNotFoundException|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Recurs o ruta no trobada.'], 404);
            }
        });

        // Gestió d'errors generals del servidor (500)
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Error del servidor.'], 500);
            }
        });
    })->create();