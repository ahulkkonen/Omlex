<?php

namespace Omlex\Provider;

use Omlex\Provider;

class iFixit extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.ifixit.com/Embed',
            [
                'https://*.ifixit.com/Guide/View/*',
            ],
            'https://www.ifixit.com',
            'iFixit'
        );
    }
}
