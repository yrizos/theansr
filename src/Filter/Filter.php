<?php

namespace Ansr\Filter;

class Filter
{
    public static function string($value)
    {
        return trim(strval($value));
    }

    public static function urlSegment($value)
    {
        $value = self::string($value);

        return '/' . ltrim($value, '/');
    }

    public static function recipient($value)
    {
        $value = self::string($value);

        if (strpos($value, '+') === 0) {
            $value = substr($value, 1);
        } else if (strpos($value, '00') === 0) {
            $value = substr($value, 2);
        }

        return $value;
    }

    public static function recipients($value)
    {
        $value = explode(',', self::string($value));
        $value = array_map(function ($item) { return self::recipient($item); }, $value);
        $value = array_filter($value);
        $value = array_unique($value);

        return implode(',', $value);
    }

    public static function httpMethod($value)
    {
        return strtoupper(self::string($value));
    }
}