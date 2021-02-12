<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Hulu extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.hulu.com/api/oembed.json', //or xml
            [
                'https://*.hulu.com/watch/*',
            ],
            'https://www.hulu.com',
            'Hulu'
        );
    }
}
