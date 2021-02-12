<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Flickr extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.flickr.com/services/oembed/',
            [
                'https://*.flickr.com/*',
            ],
            'https://www.flickr.com',
            'Flickr'
        );
    }
}
