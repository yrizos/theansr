<?php

class AccountsTest extends \PHPUnit\Framework\TestCase
{
    public function testGetBalance()
    {
        $expected = [
            "balance" => 3.14,
        ];

        $client = $this->getMockBuilder(\Ansr\Client::class)
                       ->setConstructorArgs(['', ''])
                       ->getMock();

        $client->method('getAccountBalance')->willReturn(new \Ansr\Response($expected));

        $response = $client->getAccountBalance();

        $this->assertInstanceOf(\Ansr\Response::class, $response);

        $this->assertEquals(0, $response->errorCode);
        $this->assertEquals($expected['balance'], $response->balance);
    }
}