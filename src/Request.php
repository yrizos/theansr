<?php

namespace Ansr;

use Ansr\Filter\Filter;
use Respect\Validation\Validator;

class Request
{
    private $method = 'GET';
    private $url = '';
    private $data = [];

    public function __construct(string $method, string $url, array $data = [])
    {
        $this->setMethod($method)->setUrl($url)->setData($data);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): Request
    {
        $method = Filter::httpMethod($method);

        Validator::with('Ansr\\Validation\\Rules\\');
        if (!Validator::httpMethod()->validate($method)) {
            throw new \InvalidArgumentException('Request method is invalid.');
        }

        $this->method = $method;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Request
    {
        $this->url = Filter::urlSegment($url);

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getQueryString(): string
    {
        return http_build_query($this->getData());
    }

    public function setData(array $data): Request
    {
        $this->data = $data;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getMethod() . ' ' . $this->getUrl();
    }

}