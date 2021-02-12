<?php

namespace Omlex\Provider;

use Omlex\Provider;

class PollEverywhere extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'https://www.polleverywhere.com/services/oembed/',
            [
                'https://*.polleverywhere.com/polls/*',
                'https://*.polleverywhere.com/multiple_choice_polls/*',
                'https://*.polleverywhere.com/free_text_polls/*',
            ],
            'https://www.polleverywhere.com',
            'Poll Everywhere'
        );
    }
}
