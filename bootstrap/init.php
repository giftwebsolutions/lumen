<?php
// Session lifetime seconds
$lifetime = 60 * 120;

// Session lifetimes
ini_set('session.gc_maxlifetime', $lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

// Session cookie (change secure to true in production for https)
session_set_cookie_params([
    'lifetime' => $lifetime,
    'path' => '/',
    'domain' => '.'.$_SERVER["HTTP_HOST"],
    'secure' => isset($_SERVER["HTTPS"]),
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Session start
session_start();

// Timezone
// date_default_timezone_set('Europe/Warsaw'); // Etc/UTC or Europe/Warsaw

// Charset
// ini_set('default_charset', 'utf-8');
// mb_internal_encoding('UTF-8');
// mb_http_output('UTF-8');
// mb_regex_encoding('UTF-8');

// Execution time (0 - unlimited)
// set_time_limit(600);

// Show erors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
