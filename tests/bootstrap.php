<?php

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(TEST_BASE_PATH . DIRECTORY_SEPARATOR . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(TEST_BASE_PATH);
    $dotenv->load();
    putenv('PLATIONLINE_PUBLIC_KEY='.gzinflate(base64_decode(getenv('PLATIONLINE_PUBLIC_KEY'))));
    putenv('PLATIONLINE_PRIVATE_KEY='.gzinflate(base64_decode(getenv('PLATIONLINE_PRIVATE_KEY'))));
}
