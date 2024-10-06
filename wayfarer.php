<?php

/**
 * wayfarer.php v0.1
 * 
 * One PHP file to rule them all.
 * 
 * Usage:
 *   Create .env file at the same directory where wayfarer.php is,
 *   recommended to require_once('wayfarer.php') on the top level of your PHP file.
 */

define('ROOTP', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('ENV_PREFIX', 'WAYFARER_');
set_env();
set_errors();

function set_errors()
{
  if (getenv(ENV_PREFIX . 'APP_MODE') === 'prod') {
    // Could use ini_set('log_errors', '1') to write errors into a file.
    error_reporting(0);
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
  } else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
  }
}

function set_env()
{
  $envs = preg_split('/\r\n|\r|\n/', file_get_contents(ROOTP . '.env'));
  foreach ($envs as $env) {
    putenv(ENV_PREFIX . $env);
  }
}

function dd(mixed $any)
{
  ob_clean();
  echo '<pre>';
  print_r($any);
  echo '</pre>';
  die();
}

function abort(string $msg, int $http_code = 500)
{
  http_response_code($http_code);

  if (!$msg) {
    $msg = 'Error';
  }

  echo $msg;

  die();
}

function env(string $name)
{
  return getenv(ENV_PREFIX . $name);
}

function redirect(string $where, int $http_code = 302)
{
  http_response_code($http_code);
  header('Location: ' . $where);
  die();
}
