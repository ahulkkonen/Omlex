<?php

namespace Omlex\Provider;

use Omlex\Provider;

class YouTube extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.youtube.com/oembed',
            [
                'https://*.youtube.com/*',
                'https://*.youtube.com/*',
                'https://*.youtu.be/*',
                'https://*.youtu.be/*',
            ],
            'https://www.youtube.com',
            'YouTube'
        );
    }
}
