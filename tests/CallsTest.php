<?php

class CallsTest extends \PHPUnit\Framework\TestCase
{

    public function testCall()
    {
        $expected = [
            'call_id'      => '19579d25-3190-43a9-88f3-66ac5864b7c5',
            'media_server' => '127.0.0.1',
        ];

        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->method('createCall')->willReturn(new \Ansr\Response($expected));

        $response = $client->createCall(
            '00306912345678',
            '00306912345678',
            'http://www.example.com'
        );

        $this->assertInstanceOf(\Ansr\Response::class, $response);

        $this->assertEquals(0, $response->errorCode);
        $this->assertEquals($expected['call_id'], $response->call_id);
        $this->assertEquals($expected['media_server'], $response->media_server);
    }

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
            '00306912345678',
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
            '00306912345678',
            'http://www.example.com',
            ''
        );
    }


}