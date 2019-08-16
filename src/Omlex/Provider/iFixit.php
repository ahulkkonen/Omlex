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
            'http://www.ifixit.com/Embed',
            [
                'http://*.ifixit.com/Guide/View/*',
            ],
            'http://www.ifixit.com',
            'iFixit'
        );
    }
}
