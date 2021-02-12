<?php

namespace Omlex\Provider;

use Omlex\Provider;

class SlideShare extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.slideshare.net/api/oembed/2',
            [
                'https://*.slideshare.net/*/*',
            ],
            'https://www.slideshare.net',
            'SlideShare'
        );
    }
}
