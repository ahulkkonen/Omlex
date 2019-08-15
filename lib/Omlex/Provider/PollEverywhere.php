<?php

namespace Omlex\Provider;

use Omlex\Provider;

/**
 * Poll Everywhere provider.
 */
class PollEverywhere extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        return parent::__construct(
            'http://www.polleverywhere.com/services/oembed/',
            [
                'http://*.polleverywhere.com/polls/*',
                'http://*.polleverywhere.com/multiple_choice_polls/*',
                'http://*.polleverywhere.com/free_text_polls/*',
            ],
            'http://www.polleverywhere.com',
            'Poll Everywhere'
        );
    }
}
