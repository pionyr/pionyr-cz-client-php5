<?php

namespace Pionyr\PionyrCz\Constants;

use MyCLabs\Enum\Enum;

/**
 * Constants for the most common article categories.
 * Note this is not complete list nor enum - categories are user-editable, thus may change anytime.
 *
 * @codeCoverageIgnore
 */
final class ArticleCategory
{
    const AKCE_A_SOUTEZE = 1;
    const EKONOMIKA = 2;
    const MEZINARODNI = 3;
    const PROGRAM_A_HRY = 4;
    const VZDELAVANI = 5;
    const OSTATNI = 6;
    const SETKANI = 7;
    const UVODNI_NOVINKY = 9;
    const JMKOP = 12;
    const PTO = 13;

    private function __construct()
    {
    }
}
