<?php

namespace Pionyr\PionyrCz\Constants;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Pionyr\PionyrCz\Constants\EventCategory
 */
class EventCategoryTest extends TestCase
{
    /** @test */
    public function shouldPrintCategoryDescription()
    {
        $category = new EventCategory(EventCategory::TERMIN);
        $this->assertSame('Termín', $category->__toString());
    }
}
