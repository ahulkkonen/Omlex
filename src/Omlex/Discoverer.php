<?php

namespace Omlex;

/**
 * Discover the oEmbed API URI.
 */
class Discoverer
{
    /**
     * Find all <link /> tags that have a valid oembed type set. We then
     * extract the href attribute for each type.
     */
    const LINK_REGEXP = '#<link([^>]*)type=[^"]*"(?P<Format>@formats@)\+oembed"(?P<Attributes>[^>]*)>#i';

    /**
     * Cached endpoints.
     *
     * @var array
     */
    protected $cachedEndpoints = [];

    /**
     * Supported formats.
     *
     * @var string
     */
    protected $supportedFormats = [
        'application/json',
        'text/xml',
    ];

    /**
     * Preferred format.
     *
     * @var string
     */
    protected $preferredFormat = 'application/json';

    /**
     * Get the provider's endpoint URL for the supplied resource.
     *
     * @param string $url The URL to get the endpoint's URL for
     *
     * @return string
     */
    public function getEndpointForUrl(string $url): string
    {
        if (!isset($this->cachedEndpoints[$url])) {
            $this->cachedEndpoints[$url] = $this->fetchEndpointForUrl($url);
        }

        return $this->cachedEndpoints[$url];
    }

    /**
     * Fetch the provider's endpoint URL for the supplied resource.
     *
     * @param string $url The provider's endpoint URL for the supplied resource
     *
     * @return string
     *
     * @throws \InvalidArgumentException If no valid link was found
     */
    protected function fetchEndpointForUrl(string $url): string
    {
        $client = new Client($url);

        $body = $client->send();

        $regexp = str_replace(
            '@formats@',
            implode('|', $this->supportedFormats),
            self::LINK_REGEXP
        );

        if (!preg_match_all($regexp, $body, $matches, PREG_SET_ORDER)) {
            throw new \InvalidArgumentException('No valid oEmbed links found on page.');
        }

        foreach ($matches as $match) {
            if ($match['Format'] === $this->preferredFormat) {
                return $this->extractEndpointFromAttributes($match['Attributes']);
            }
        }

        return $this->extractEndpointFromAttributes($match['Attributes']);
    }

    /**
     * Extract the endpoint's URL from the <link>'s tag attributes.
     *
     * @param string $attributes The attributes of the <link> tag
     *
     * @return string
     *
     * @throws \InvalidArgumentException If not href was found
     */
    protected function extractEndpointFromAttributes(string $attributes): string
    {
        if (!preg_match('/href=[^"]*"([^"]+)"/i', $attributes, $matches)) {
            throw new \InvalidArgumentException('No "href" attribute was found in <link> tag.');
        }

        return $matches[1];
    }
}
