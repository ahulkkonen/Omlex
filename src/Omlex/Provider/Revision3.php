<?php

namespace Omlex\Provider;

use Omlex\Provider;

class Revision3 extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://revision3.com/api/oembed/',
            [
                'https://*.revision3.com/*',
            ],
            'https://www.revision3.com',
            'Revision3'
        );
    }
}
