<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * SmugMug provider.
 */
class SmugMug extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://api.smugmug.com/services/oembed/',
            [
                'http://*.smugmug.com/*',
            ],
            'http://www.smugmug.com',
            'SmugMug'
        );
    }
}
