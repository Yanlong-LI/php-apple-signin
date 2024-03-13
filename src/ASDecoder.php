<?php

namespace AppleSignIn;

use Exception;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Decode Sign In with Apple identity token, and produce an ASPayload for
 * utilizing in backend auth flows to verify validity of provided user creds.
 *
 * @package  AppleSignIn\ASDecoder
 * @author   Griffin Ledingham <gcledingham@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/GriffinLedingham/php-apple-signin
 */
class ASDecoder
{

    /**
     * Cache Hook
     * @var string curl response
     */
    public static $responseKeys = "";

    /**
     * Parse a provided Sign In with Apple identity token.
     *
     * @param string $identityToken
     * @param array $allowedAlgorithms
     * @return object|null
     * @throws Exception|GuzzleException
     */
    public static function getAppleSignInPayload($identityToken, $allowedAlgorithms)
    {
        return new ASPayload(JWT::decode($identityToken, self::fetchPublicKey(),$allowedAlgorithms));
    }

    /**
     * Fetch Apple's public key from the auth/keys REST API to use to decode
     * the Sign In JWT.
     *
     * @return array
     * @throws Exception
     * @throws GuzzleException
     */
    public static function fetchPublicKey()
    {
        if (!self::$responseKeys) {
            $ch = new Client();
            self::$responseKeys  = $ch->get('https://appleid.apple.com/auth/keys')->getBody()->getContents();
        }
        return JWK::parseKeySet(json_decode(self::$responseKeys, true));
    }
}

