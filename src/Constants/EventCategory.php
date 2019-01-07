<?php

namespace Pionyr\PionyrCz\Constants;

use MyCLabs\Enum\Enum;

/**
 * @method static EventCategory JEDNANI_ORGANU()
 * @method static EventCategory TERMIN()
 * @method static EventCategory MEZINARODNI()
 * @method static EventCategory VZDELAVACI()
 * @method static EventCategory TABOR()
 * @method static EventCategory AKCE()
 */
final class EventCategory extends Enum
{
    const JEDNANI_ORGANU = 1;
    const TERMIN = 2;
    const MEZINARODNI = 3;
    const VZDELAVACI = 4;
    const TABOR = 5;
    const AKCE = 6;
    /** @var string[] */
    private $descriptions = [self::JEDNANI_ORGANU => 'Jednání orgánů', self::TERMIN => 'Termín', self::MEZINARODNI => 'Mezinárodní', self::VZDELAVACI => 'Vzdělávací', self::TABOR => 'Tábor', self::AKCE => 'Akce'];

    public function __toString()
    {
        return $this->descriptions[$this->getValue()];
    }
}
