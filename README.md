# PHP client for ansr API


API documentation: https://github.com/theansr/api

### Usage

    $client = new \Ansr\Client(
        'api_key',
        'password'
    );
    
    $client->createCall(
        'from',
        'to',
        'answer_url',   
    );

