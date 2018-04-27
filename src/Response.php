<?php

namespace Ansr;

use Psr\Http\Message\ResponseInterface;

class Response extends \ArrayObject
{
    public function __construct($response)
    {
        $this->setResponse($response);
    }

    public function setResponse($response): Response
    {
        if ($response instanceof ResponseInterface) {
            $response = strval($response->getBody());
        }

        if (is_string($response)) {
            $response = @json_decode($response, true);
        }

        if (!is_array($response) || empty($response)) {
            throw new \InvalidArgumentException('Invalid response.');
        }

        $response = array_merge(
            [
                'errorCode' => 0,
            ],
            $response
        );

        foreach ($response as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }


}