<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_ENV'] ?? 'dev';
$debug = $_SERVER['APP_DEBUG'] ?? ('prod' !== $env);

if ($debug) {
    umask(0000);

    Debug::enable();
}

$kernel = new Kernel($env, $debug);
$request = Request::createFromGlobals();

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
//    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL);
    Request::setTrustedProxies(
    // trust *all* requests
        array('127.0.0.1', $request->server->get('REMOTE_ADDR')),

        // if you're using ELB, otherwise use a constant from above
        Request::HEADER_X_FORWARDED_AWS_ELB
    );
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts(explode(',', $trustedHosts));
}


$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
