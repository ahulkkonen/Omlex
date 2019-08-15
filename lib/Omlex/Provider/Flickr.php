<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * Flickr provider.
 */
class Flickr extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://www.flickr.com/services/oembed/',
            [
                'http://*.flickr.com/*',
            ],
            'http://www.flickr.com',
            'Flickr'
        );
    }
}
