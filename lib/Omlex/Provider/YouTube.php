<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * YouTube provider.
 */
class YouTube extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://www.youtube.com/oembed',
            [
                'http://*.youtube.com/*',
                'https://*.youtube.com/*',
                'http://*.youtu.be/*',
                'https://*.youtu.be/*',
            ],
            'http://www.youtube.com',
            'YouTube'
        );
    }
}
