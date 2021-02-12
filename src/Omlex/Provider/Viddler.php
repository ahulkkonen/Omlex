<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Viddler extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://lab.viddler.com/services/oembed/',
            [
                'https://*.viddler.com/*',
            ],
            'https://www.viddler.com',
            'Viddler'
        );
    }
}
