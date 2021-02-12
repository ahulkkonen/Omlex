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
            'https://qik.com/api/oembed.json', //or xml
            [
                'https://*.qik.com/video/*',
                'https://*.qik.com/*',
            ],
            'https://www.qik.com',
            'Qik'
        );
    }
}
