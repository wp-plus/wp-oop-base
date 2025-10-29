<?php

namespace WpPlus\WpOopBase\Helper;

defined('HOUR_IN_SECONDS') || define('HOUR_IN_SECONDS', 3600);

class DateTime
{
    private function __construct()
    {
        // We do not want this class instantiated
    }

    /**
     * @deprecated Use wp_date() directly instead.
     * @api
     */
    static function offsetAwareFormat($time, $format = 'Y-m-d H:i:s'): string
    {
        return wp_date($format, $time);
    }

    /**
     * Retrieve formatted date time based on specified type.
     *
     * Fully based on WordPress' current_time(), the only difference is that the $timestamp is not hard-coded to time().
     *
     * The 'mysql' type will return the time in the format for MySQL DATETIME field.
     * The 'timestamp' type will return the current timestamp.
     * Other strings will be interpreted as PHP date formats (e.g. 'Y-m-d').
     *
     * If $gmt is set to either '1' or 'true', then both types will use GMT time.
     * if $gmt is false, the output is adjusted with the GMT offset in the WordPress option.
     *
     * @param int $timestamp Unix timestamp to format.
     * @param string   $type Type of time to retrieve. Accepts 'mysql', 'timestamp', or PHP date
     *                       format string (e.g. 'Y-m-d').
     * @param int|bool $gmt  Optional. Whether to use GMT timezone. Default false.
     * @return int|string Integer if $type is 'timestamp', string otherwise.
     */
    static function format(int $timestamp, string $type, int|bool $gmt = 0): int|string
    {
        return match ($type) {
            'mysql' => ($gmt)
                ? gmdate('Y-m-d H:i:s', $timestamp)
                : gmdate('Y-m-d H:i:s', ($timestamp + (get_option('gmt_offset') * HOUR_IN_SECONDS))
            ),
            'timestamp' =>
                ($gmt)
                    ? $timestamp
                    : $timestamp + (get_option('gmt_offset') * HOUR_IN_SECONDS),
            default =>
                ($gmt)
                    ? date($type, $timestamp)
                    : date($type, $timestamp + (get_option('gmt_offset') * HOUR_IN_SECONDS)),
        };
    }
}
