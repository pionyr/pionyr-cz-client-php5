<?php

namespace Pionyr\PionyrCz\Constants;

use MyCLabs\Enum\Enum;

/**
 * @method static EventLocalization REGIONAL()
 * @method static EventLocalization NATIONWIDE()
 */
final class EventLocalization extends Enum
{
    const REGIONAL = '1';
    const NATIONWIDE = '2';
    /** @var string[] */
    private $descriptions = [self::REGIONAL => 'Regionální', self::NATIONWIDE => 'Celorepubliková'];

    public function __toString()
    {
        return $this->descriptions[$this->getValue()];
    }
}
