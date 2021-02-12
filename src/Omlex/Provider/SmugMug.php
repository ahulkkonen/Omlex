<?php

namespace Omlex\Provider;

use Omlex\Provider;

class SmugMug extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://api.smugmug.com/services/oembed/',
            [
                'https://*.smugmug.com/*',
            ],
            'https://www.smugmug.com',
            'SmugMug'
        );
    }
}
