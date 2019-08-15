<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * Revision3 provider.
 */
class Revision3 extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://revision3.com/api/oembed/',
            [
                'http://*.revision3.com/*',
            ],
            'http://www.revision3.com',
            'Revision3'
        );
    }
}
