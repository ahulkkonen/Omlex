<?php

namespace Omlex;

/**
 * Base class for providers.
 */
class Provider
{
    /**
     * The API endpoint.
     *
     * @var string
     */
    protected $endpoint = null;

    /**
     * The URL schems.
     *
     * @var array
     */
    protected $schemes = [];

    /**
     * The website URL.
     *
     * @var string
     */
    protected $url = null;

    /**
     * The provider name.
     *
     * @var string
     */
    protected $name = null;

    /**
     * Constructor.
     *
     * @param string $endpoint The API endpoint
     * @param array  $schemes  The URL schemes
     * @param string $url      The website URL
     * @param string $name     The provider name
     */
    public function __construct(string $endpoint = null, array $schemes = [], string $url = null, string $name = null)
    {
        foreach ($schemes as $key => $scheme) {
            if (!is_object($scheme) || !($scheme instanceof URLScheme)) {
                if (is_string($scheme)) {
                    $schemes[$key] = new URLScheme($scheme);
                } else {
                    unset($schemes[$key]);
                }
            }
        }

        $this->endpoint = $endpoint;
        $this->schemes = $schemes;
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Check whether the given URL match one of the provider's schemes.
     *
     * @param string $url The URL to check against
     *
     * @return bool True if match, false if not
     */
    public function match(string $url): bool
    {
        if (!$this->schemes) {
            return true;
        }

        foreach ($this->schemes as $scheme) {
            if ($scheme->match($url)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the provider's URL schemes.
     *
     * @return array
     */
    public function getSchemes(): array
    {
        return $this->schemes;
    }

    /**
     * Get the provider's API endpoint.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get the provider's URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get the provider's name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
