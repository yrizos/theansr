<?php

namespace Ansr;

class Response extends \ArrayObject
{
    public function __construct($data)
    {
        $this->setData($data);
    }

    public function setData($data): Response
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an array');
        }

        $data = array_merge(
            [
                'errorCode' => 0,
            ],
            $data
        );

        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                continue;
            }

            $this->$key = $value;
        }

        return $this;
    }


}