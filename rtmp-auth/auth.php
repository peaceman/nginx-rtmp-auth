<?php

$auth = require_once 'auth-config.php';

function abort() {
    http_response_code(401);
    exit;
}

$streamKey = $_POST['name'] ?? null;
if (!($streamAuth = $auth[$streamKey] ?? null)) abort();

$queryString = parse_url($_POST['tcurl'], PHP_URL_QUERY);
if (!$queryString) abort();

parse_str($queryString, $queryParams);

if ($streamAuth['secret'] ?? '' !== $queryParams['secret'] ?? '')
    abort();
