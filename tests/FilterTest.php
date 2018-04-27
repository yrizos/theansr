<?php

class FilterTest extends \PHPUnit\Framework\TestCase
{

    public function testHttpMethod()
    {
        $this->assertEquals('GET', \Ansr\Filter\Filter::httpMethod(' GeT '));
        $this->assertEquals('GET', \Ansr\Filter\Filter::httpMethod(' get '));
    }

    public function testRecipients()
    {
        $this->assertEquals('306912345678,306912345679,306912345676', \Ansr\Filter\Filter::recipients('00306912345678,    00306912345678, , 00306912345679, +306912345676'));
    }

}