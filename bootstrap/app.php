<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\petugasperpustakaan::class,
            'super-admin' => \App\Http\Middleware\penanggungjawabperpustakaan::class,
            'kepala-sekolah' => \App\Http\Middleware\kepalasekolah::class,
            'administrasi' => \App\Http\Middleware\administrasi::class,
            'siswa' => \App\Http\Middleware\siswa::class,

            'kepala-sekolah-or-superadmin' => \App\Http\Middleware\kepalasekolahorsuperadmin::class,
            'superadmin-or-admin' => \App\Http\Middleware\petugasperpustakaanorpenanggungjawabperpustakaan::class,
        ]);
        $middleware->redirectGuestsTo('login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
