<?php

class SmsTest extends \PHPUnit\Framework\TestCase
{

    public function testCreateSms()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->method('createSms')->willReturn(new \Ansr\Response('{"balance":5.1}'));

        $response = $client->createSms(
            'etable',
            '00306942464788',
            'test'
        );

        $this->assertEquals($response->errorCode, 0);
        $this->assertEquals($response->balance, 5.1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShortSender()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createSms'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createSms(
            '123',
            '',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLongNumericSender()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createSms'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createSms(
            '123456789012345',
            '',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLongAlnumSender()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createSms'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createSms(
            'a23456789012',
            '',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidRecipient()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createSms'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createSms(
            '1234',
            'a,b,c',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidBody()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createSms'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createSms(
            '1234',
            '00306912345678',
            '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890+'
        );
    }
}