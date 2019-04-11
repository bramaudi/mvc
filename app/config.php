<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Debug mode enabled will show error in specific details
 * otherwise error just showing a simple html page
 */
define('DEBUG_MODE', 1);

/**
 * Database configuration
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'nulis');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Use for accessing assets in views
 */
define('BASEURL', '//localhost:8080/');