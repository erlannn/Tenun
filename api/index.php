<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$storagePath = '/tmp/storage';
$bootstrapCachePath = '/tmp/bootstrap/cache';

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
    $bootstrapCachePath,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Storage paths
putenv('LARAVEL_STORAGE_PATH=' . $storagePath);
$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';

// Cache paths for serverless read-only filesystem
$cacheEnv = [
    'APP_SERVICES_CACHE' => $bootstrapCachePath . '/services.php',
    'APP_PACKAGES_CACHE' => $bootstrapCachePath . '/packages.php',
    'APP_CONFIG_CACHE'   => $bootstrapCachePath . '/config.php',
    'APP_ROUTES_CACHE'   => $bootstrapCachePath . '/routes-v7.php',
    'APP_EVENTS_CACHE'   => $bootstrapCachePath . '/events.php',
];

foreach ($cacheEnv as $key => $val) {
    putenv("{$key}={$val}");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
}

// Session configuration defaults for serverless environment
$sessionEnv = [
    'SESSION_DRIVER'          => 'database',
    'SESSION_LIFETIME'        => '120',
    'SESSION_EXPIRE_ON_CLOSE' => 'false',
    'SESSION_ENCRYPT'         => 'false',
    'SESSION_PATH'            => '/',
    'SESSION_COOKIE'          => 'riskasulam_session',
    'SESSION_SECURE_COOKIE'   => 'true',
    'SESSION_SAME_SITE'       => 'lax',
    'BCRYPT_ROUNDS'           => '12',
    'HASH_DRIVER'             => 'bcrypt',
];

foreach ($sessionEnv as $key => $val) {
    if (empty(getenv($key))) {
        putenv("{$key}={$val}");
        $_ENV[$key] = $val;
        $_SERVER[$key] = $val;
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