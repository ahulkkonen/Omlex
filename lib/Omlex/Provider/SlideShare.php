<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * SlideShare provider.
 */
class SlideShare extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://www.slideshare.net/api/oembed/2',
            [
                'http://*.slideshare.net/*/*',
            ],
            'http://www.slideshare.net',
            'SlideShare'
        );
    }
}
