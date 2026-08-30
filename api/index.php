<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/app',
    $storagePath . '/app/public',
    $storagePath . '/framework',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
    '/tmp/bootstrap',
    '/tmp/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo '<div style="padding:20px; font-family: sans-serif; background: #fff0f0; border: 2px solid #ff4d4d; border-radius: 8px; margin: 20px;">';
    echo '<h2 style="color: #cc0000; margin-top:0;">⚠️ Laravel Execution Error</h2>';
    echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ' (Line: <strong>' . $e->getLine() . '</strong>)</p>';
    echo '<h3>Stack Trace:</h3>';
    echo '<pre style="background: #222; color: #eee; padding: 15px; border-radius: 5px; overflow-x: auto;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
    error_log($e->getMessage());
}