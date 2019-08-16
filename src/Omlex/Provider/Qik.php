<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Qik extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://qik.com/api/oembed.json', //or xml
            [
                'http://*.qik.com/video/*',
                'http://*.qik.com/*',
            ],
            'http://www.qik.com',
            'Qik'
        );
    }
}
