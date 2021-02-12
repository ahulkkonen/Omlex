<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Vimeo extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://vimeo.com/api/oembed.json', //or xml
            [
                'https://*.vimeo.com/*',
                'https://*.vimeo.com/*',
            ],
            'https://www.vimeo.com',
            'Vimeo'
        );
    }
}
