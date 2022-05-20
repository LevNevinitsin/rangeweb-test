<?php
namespace LevNevinitsin\Service;

class UrlService
{
    public static function getRandomString (
        int $length = 10,
        string $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
    )
    {
        $result = '';
        $alphabetMaxIndex = strlen($alphabet) - 1;

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $alphabetMaxIndex);
            $result .= substr($alphabet, $randomIndex, 1);
        }

        return $result;
    }
}
