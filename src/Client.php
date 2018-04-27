<?php

namespace Ansr;

use Ansr\Filter\Filter;
use GuzzleHttp\Client as GuzzleHttpClient;
use Respect\Validation\Validator;

class Client
{
    const NAME = 'yrizos/theansr';
    const VERSION = '0.1.1';
    const BASE_URL = 'https://api.theansr.com';

    private $api_version = 'v1';
    private $api_key = '';
    private $password = '';

    public function __construct(string $api_key, string $password, string $api_version = 'v1')
    {
        $this->setApiKey($api_key)->setPassword($password)->setApiVersion($api_version);
    }

    public function createCall(
        string $sender,
        string $recipient,
        string $answer_url,
        string $answer_method = 'GET'
    )
    {
        $sender        = Filter::string($sender);
        $recipient     = Filter::recipient($recipient);
        $answer_url    = Filter::string($answer_url);
        $answer_method = Filter::httpMethod($answer_method);

        Validator::with('Ansr\\Validation\\Rules\\');

        if (!Validator::recipient()->validate($recipient)) {
            throw new \InvalidArgumentException('The destination number should be in full international format.');
        }

        if (!Validator::url()->validate($answer_url)) {
            throw new \InvalidArgumentException('Answer url is invalid.');
        }

        if (!Validator::httpMethod()->validate($answer_method)) {
            throw new \InvalidArgumentException('Answer method is invalid.');
        }

        return $this->execute(new Request(
            'POST',
            '/calls',
            [
                'from'          => $sender,
                'to'            => $recipient,
                'answer_url'    => $answer_url,
                'answer_method' => $answer_method,
            ]
        ));
    }

    public function createSms(
        string $sender,
        $recipients,
        string $body
    )
    {
        $sender     = Filter::string($sender);
        $recipients = Filter::recipients($recipients);
        $body       = Filter::string($body);

        Validator::with('Ansr\\Validation\\Rules\\');

        if (!Validator::sender()->validate($sender)) {
            throw new \InvalidArgumentException('Sender is invalid.');
        }

        if (!Validator::recipients()->validate($recipients)) {
            throw new \InvalidArgumentException('Recipients are invalid.');
        }

        if (!Validator::smsBody()->validate($body)) {
            throw new \InvalidArgumentException('SMS body is invalid.');
        }

        return $this->execute(new Request(
            'POST',
            '/sms',
            [
                'sender'     => $sender,
                'recipients' => $recipients,
                'body'       => $body,
            ]
        ));
    }

    public function createPinVerificationSms(
        string $sender,
        $recipients,
        int $num_of_digits = 4
    )
    {
        return $this->execute(new Request(
            'POST',
            '/sms/verification_pin',
            [
                'sender'         => $sender,
                'recipients'     => $recipients,
                'num_of_digits ' => $num_of_digits,
            ]
        ));
    }

    public function getAccountBalance(): Response
    {
        return $this->execute(new Request(
            'GET',
            '/accounts/get_balance'
        ));
    }

    public function execute(Request $request): Response
    {
        $client  = new GuzzleHttpClient();
        $options = [
            'headers' => [
                'User-Agent' => self::NAME . '/' . self::VERSION . ' (+https://github.com/yrizos/theansr)',
            ],
            'auth'    => [
                $this->getApiKey(),
                $this->getPassword(),
            ],
        ];

        if ($request->getMethod() == 'POST') {
            $options['form_params'] = $request->getData();
        }

        var_dump($request);


        $response = $client->request(
            $request->getMethod(),
            $this->getRequestUrl($request),
            $options
        );

        return new Response($response);
    }

    public function getRequestUrl(Request $request): string
    {
        $url = [self::BASE_URL, $this->getApiVersion(), $request->getUrl()];
        $url = array_map(function ($item) {
            return trim($item, '/');
        }, $url);

        return implode('/', $url);
    }

    public function getApiVersion(): string
    {
        return $this->api_version;
    }

    public function setApiVersion(string $api_version): Client
    {
        $this->api_version = strtolower($api_version);

        return $this;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function setApiKey(string $api_key): Client
    {
        $this->api_key = $api_key;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Client
    {
        $this->password = $password;

        return $this;
    }


}