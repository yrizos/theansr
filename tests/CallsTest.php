<?php

class CallsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidRecipient()
    {

        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createCall'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createCall(
            'sender',
            'recipient',
            '',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidAnswerUrl()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createCall'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createCall(
            'sender',
            '00306942464788',
            '',
            ''
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidAnswerMethod()
    {
        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setMethodsExcept(['createCall'])
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->createCall(
            'sender',
            '00306942464788',
            'http://www.example.com',
            ''
        );
    }


}