<?php

class SmsTest extends \PHPUnit\Framework\TestCase
{

    public function testCreateSms()
    {
        $expected = [
            "balance" => 3.14
        ];

        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->method('createSms')->willReturn(new \Ansr\Response($expected));

        $response = $client->createSms(
            'etable',
            '00306912345678',
            'test'
        );

        $this->assertInstanceOf(\Ansr\Response::class, $response);

        $this->assertEquals(0, $response->errorCode);
        $this->assertEquals($expected['balance'], $response->balance);
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