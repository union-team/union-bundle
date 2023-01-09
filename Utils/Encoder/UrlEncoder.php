<?php

declare(strict_types=1);

namespace Union\Bundle\UnionBundle\Utils\Encoder;

class UrlEncoder
{
    public static function base64UrlEncode(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    public static function base64UrlDecode(string $string): string
    {
        return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '='));
    }

    public static function base64RawUrlEncode(string $string): string
    {
        return rawurlencode(base64_encode($string));
    }

    public static function base64RawUrlDecode(string $string): string
    {
        return base64_decode(rawurldecode($string));
    }
}
