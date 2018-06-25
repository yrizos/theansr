# PHP client for ansr API

API documentation: https://github.com/theansr/api

### Supported endpoints

- `GET /accounts/get_balance` 
- `POST /calls`
- `POST /sms`




### Installation

    $ composer require yrizos/theansr

### Usage

    <?php 

    $client = new \Ansr\Client(
        'api_key',
        'password'
    );
    
    $response = $client->createCall(
        'from',
        'to',
        'answer_url',   
    );

