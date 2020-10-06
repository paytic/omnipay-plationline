<?php

$parameters = isset($parameters) ? $parameters : [];

$parameters = array_merge(
    $parameters,
    [
        'loginId' => getenv('PLATIONLINE_LOGIN_ID'),
        'publicKey' => getenv('PLATIONLINE_PUBLIC_KEY'),
        'privateKey' => getenv('PLATIONLINE_PRIVATE_KEY'),
        'website' => getenv('PLATIONLINE_WEBSITE'),
        'initialVector' => getenv('PLATIONLINE_INITIAL_VECTOR'),
        'initialVectorItsn' => getenv('PLATIONLINE_INITIAL_VECTOR_ITSN'),
        'testMode' => true
    ]
);

return $parameters;
