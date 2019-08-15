<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * @author  Evert Harmeling <evert.harmeling@freshheads.com>
 */
class Twitter extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://api.twitter.com/1/statuses/oembed.json',
            [
                'http://twitter.com/*/status/*',
                'https://twitter.com/*/status/*',
            ],
            'http://twitter.com',
            'Twitter'
        );
    }
}
