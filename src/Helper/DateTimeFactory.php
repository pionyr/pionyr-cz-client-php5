<?php

namespace Pionyr\PionyrCz\Helper;

use Pionyr\PionyrCz\Exception\ResponseDecodingException;

class DateTimeFactory
{
    public static function fromNullableInputString($inputString = null)
    {
        if ($inputString === null) {
            return null;
        }

        return static::fromInputString($inputString);
    }

    public static function fromInputString($inputString)
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $inputString);
        if ($date === false) {
            throw new ResponseDecodingException(sprintf('Error creating date from string "%s"', $inputString));
        }

        return $date;
    }
}
