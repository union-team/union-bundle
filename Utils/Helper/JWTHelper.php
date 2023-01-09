<?php

declare(strict_types=1);

namespace Union\Bundle\UnionBundle\Utils\Helper;

use Union\Bundle\UnionBundle\Utils\Encoder\UrlEncoder;

class JWTHelper
{
    public const DEFAULT_ALGORITHM = 'HS512';
    private const HMAC_ALGORITHM_MAPPING = [
        'HS512' => 'sha512',
        'HS256' => 'sha256',
    ];

    public static function checkToken(string $token, string $salt): bool
    {
        [$header, $claim, $signature] = explode('.', $token);
        $headerData = json_decode(UrlEncoder::base64UrlDecode($header), true);
        if (empty($header) || empty($claim) || !is_array($headerData)) {
            return false;
        }

        $unsignedToken = sprintf('%s.%s', $header, $claim);

        return static::getSignature($unsignedToken, $salt, $headerData['alg']) === $signature;
    }

    public static function getTokenData(string $token): array
    {
        $claim = explode('.', $token)[1] ?? null;

        return empty($claim) ? [] : (array) json_decode(UrlEncoder::base64UrlDecode($claim), true);
    }

    public static function generateToken(array $claim, string $salt, string $algorithm = self::DEFAULT_ALGORITHM): string
    {
        $token = implode(
            '.',
            [
                UrlEncoder::base64UrlEncode(
                    static::generateHeader($algorithm)
                ),
                UrlEncoder::base64UrlEncode(
                    (string) json_encode($claim)
                ),
            ]
        );

        return sprintf('%s.%s', $token, static::getSignature($token, $salt, $algorithm));
    }

    protected static function getSignature(string $token, string $salt, string $algorithm = self::DEFAULT_ALGORITHM): string
    {
        if (!isset(self::HMAC_ALGORITHM_MAPPING[$algorithm])) {
            return '';
        }

        $signature = hash_hmac(self::HMAC_ALGORITHM_MAPPING[$algorithm], $token, $salt, true);

        return UrlEncoder::base64UrlEncode($signature);
    }

    protected static function generateHeader(string $alg = self::DEFAULT_ALGORITHM): string
    {
        $headerArray = [
            'typ' => 'JWT',
            'alg' => $alg,
        ];

        return (string) json_encode($headerArray);
    }
}
