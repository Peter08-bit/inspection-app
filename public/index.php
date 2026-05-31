<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Créer dossiers storage pour App Engine
if (getenv('GAE_APPLICATION')) {
    $dirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/logs',
        '/tmp/storage/app',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) mkdir($dir, 0775, true);
    }
}

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

// Utiliser /tmp/storage sur App Engine
if (getenv('GAE_APPLICATION')) {
    $app->useStoragePath('/tmp/storage');
}

$app->handleRequest(Request::capture());