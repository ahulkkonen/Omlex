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
            'http://vimeo.com/api/oembed.json', //or xml
            [
                'http://*.vimeo.com/*',
                'https://*.vimeo.com/*',
            ],
            'http://www.vimeo.com',
            'Vimeo'
        );
    }
}
