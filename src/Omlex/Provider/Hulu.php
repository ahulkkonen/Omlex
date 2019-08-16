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
            'http://www.hulu.com/api/oembed.json', //or xml
            [
                'http://*.hulu.com/watch/*',
            ],
            'http://www.hulu.com',
            'Hulu'
        );
    }
}
