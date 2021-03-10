<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sql_date_to_format()
    {
        $origitalDateStamp = '2021-03-09 22:00:00';
        $formattedDateStamp = sql_date_to_format($origitalDateStamp, 'l, F jS, Y \\a\\t g:i a');
        $this->assertEquals($formattedDateStamp, 'Tuesday, March 9th, 2021 at 10:00 pm');
    }
}
