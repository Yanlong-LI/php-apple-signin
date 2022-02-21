<?php

include '../vendor/autoload.php';

use AppleSignIn\ASDecoder;

$clientUser = "example_client_user";
$identityToken = "example_encoded_jwt";

// option
// set keys cache
$cacheKeys = "";
ASDecoder::$responseKeys = $cacheKeys;

$appleSignInPayload = ASDecoder::getAppleSignInPayload($identityToken);

// option
// save keys cache
$cacheKeys = ASDecoder::$responseKeys;

/**
 * Obtain the Sign In with Apple email and user creds.
 */
$email = $appleSignInPayload->getEmail();
$user = $appleSignInPayload->getUser();

/**
 * Determine whether the client-provided user is valid.
 */
$isValid = $appleSignInPayload->verifyUser($clientUser);


