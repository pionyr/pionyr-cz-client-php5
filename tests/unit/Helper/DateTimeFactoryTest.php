<?php

namespace Pionyr\PionyrCz\Helper;

use PHPUnit\Framework\TestCase;
use Pionyr\PionyrCz\Exception\ResponseDecodingException;

/**
 * @covers \Pionyr\PionyrCz\Helper\DateTimeFactory
 */
class DateTimeFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideDateStrings
     * @param mixed $inputString
     * @param \DateTimeImmutable $expected
     */
    public function shouldCreateDateFromInputString($inputString, \DateTimeImmutable $expected)
    {
        $dateTime = DateTimeFactory::fromInputString($inputString);
        $this->assertEquals($expected, $dateTime);
    }

    /**
     * @return array[]
     */
    public function provideDateStrings()
    {
        return [['2018-04-27 13:33:34', new \DateTimeImmutable('2018-04-27 13:33:34')], ['2017-01-02 01:03:04', new \DateTimeImmutable('2017-01-02 01:03:04')]];
    }

    /**
     * @test
     * @dataProvider provideDateStrings
     * @dataProvider provideNull
     * @param null|mixed $inputString
     * @param null|\DateTimeImmutable $expected
     */
    public function shouldCreateNullableDateFromInputString($inputString = null, \DateTimeImmutable $expected = null)
    {
        $dateTime = DateTimeFactory::fromNullableInputString($inputString);
        $this->assertEquals($expected, $dateTime);
    }

    /**
     * @return array[]
     */
    public function provideNull()
    {
        return [[null, null]];
    }

    /** @test */
    public function shouldThrowExceptionWhenCannotCreateFromFormat()
    {
        $this->expectException(ResponseDecodingException::class);
        $this->expectExceptionMessage('Error creating date from string "fooBar"');
        DateTimeFactory::fromInputString('fooBar');
    }
}
