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

    // Force SQLite to use /tmp
    $dbConnection = $_ENV['DB_CONNECTION'] ?? getenv('DB_CONNECTION');
    
    if ($dbConnection === 'sqlite') {
        $dbPath = '/tmp/database.sqlite';
        if (!file_exists($dbPath)) {
            touch($dbPath);
        }
        // Set env vars so Laravel config picks them up later
        $_ENV['DB_DATABASE'] = $dbPath;
        putenv("DB_DATABASE={$dbPath}");
    }
}

$app->handleRequest(Request::capture());
