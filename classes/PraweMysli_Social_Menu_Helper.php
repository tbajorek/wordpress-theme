<?php

class PraweMysli_Social_Menu_Helper
{
    public static function getSocialType(string $url): ?string
    {
        $host = parse_url($url, PHP_URL_HOST);
        $host = array_reverse(explode('.', $host));
        return $host[1] ?? null;
    }

    public static function getIcon(?string $socialType): ?string
    {
        switch ($socialType) {
            case 'facebook':
            case 'twitter':
                return $socialType;
            default:
                return null;
        }
    }
}