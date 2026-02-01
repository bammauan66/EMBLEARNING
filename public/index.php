<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Fix for Vercel read-only filesystem
if (array_key_exists('VERCEL', $_SERVER) || array_key_exists('VERCEL', $_ENV)) {
    // Capture and bind request early so Exception Handler can use it
    $request = Request::capture();
    $app->instance('request', $request);

    $app->useStoragePath('/tmp/storage');
    
    // Ensure storage subdirectories exist
    if (!is_dir('/tmp/storage/framework/views')) {
        mkdir('/tmp/storage/framework/views', 0777, true);
    }
    if (!is_dir('/tmp/storage/framework/sessions')) {
        mkdir('/tmp/storage/framework/sessions', 0777, true);
    }
    if (!is_dir('/tmp/storage/framework/cache')) {
        mkdir('/tmp/storage/framework/cache', 0777, true);
    }
    if (!is_dir('/tmp/storage/logs')) {
        mkdir('/tmp/storage/logs', 0777, true);
    }

    if (isset($_ENV['DB_CONNECTION']) && $_ENV['DB_CONNECTION'] === 'sqlite') {
        $dbPath = '/tmp/database.sqlite';
        // Check if DB is missing OR empty (0 bytes) indicating a failed previous init
        $needsMigration = !file_exists($dbPath) || filesize($dbPath) === 0;
        
        if ($needsMigration) {
            // Ensure file exists for connection
            if (!file_exists($dbPath)) {
                touch($dbPath);
            }
        }
        
        // Set env vars so Laravel config picks them up later
        $_ENV['DB_DATABASE'] = $dbPath;
        putenv("DB_DATABASE={$dbPath}");

        if ($needsMigration) {
            try {
                $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
                $kernel->bootstrap();
                $kernel->call('migrate', ['--force' => true]);

                // Seed default users for ephemeral DB
                \App\Models\User::create([
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]);
                
                \App\Models\User::create([
                    'name' => 'Student User',
                    'email' => 'student@example.com',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'role' => 'student',
                    'email_verified_at' => now(),
                ]);
            } catch (\Throwable $e) {
                // Log failure but allow app to proceed (so we see the error in logs, not a white screen)
                error_log("Migration/Seed Failed: " . $e->getMessage());
                error_log($e->getTraceAsString());
            }
        }
    }
    
    // Redirect Laravel bootstrap caches to /tmp (Writable)
    $cachePath = '/tmp/bootstrap-cache';
    if (!is_dir($cachePath)) {
        mkdir($cachePath, 0777, true);
    }
    
    putenv("APP_PACKAGES_CACHE={$cachePath}/packages.php");
    putenv("APP_SERVICES_CACHE={$cachePath}/services.php");
    putenv("APP_CONFIG_CACHE={$cachePath}/config.php");
    putenv("APP_ROUTES_CACHE={$cachePath}/routes.php");
    putenv("APP_EVENTS_CACHE={$cachePath}/events.php");
    
    $_ENV['APP_PACKAGES_CACHE'] = "{$cachePath}/packages.php";
    $_ENV['APP_SERVICES_CACHE'] = "{$cachePath}/services.php";
    $_ENV['APP_CONFIG_CACHE'] = "{$cachePath}/config.php";
    $_ENV['APP_ROUTES_CACHE'] = "{$cachePath}/routes.php";
    $_ENV['APP_EVENTS_CACHE'] = "{$cachePath}/events.php";
    
    $app->handleRequest($request);
} else {
    $app->handleRequest(Request::capture());
}
