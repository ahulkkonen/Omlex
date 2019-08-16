<?php

namespace Omlex;

/**
 * Client simulates a browser.
 */
class Client
{
    protected $ignoreErrors = true;
    protected $maxRedirects = 5;
    protected $timeout = 5;
    protected $url = null;

    /**
     * Constructor.
     *
     * @param string $url The URL to fetch from
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Send a GET request.
     *
     * @return string The contents of the response
     *
     * @throws \RuntimeException On HTTP errors
     */
    public function send(): string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, []);
        curl_setopt($curl, CURLOPT_POSTFIELDS, null);

        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0 < $this->maxRedirects);
        curl_setopt($curl, CURLOPT_MAXREDIRS, $this->maxRedirects);
        curl_setopt($curl, CURLOPT_FAILONERROR, !$this->ignoreErrors);

        $data = curl_exec($curl);
        if (false === $data) {
            $errorMsg = curl_error($curl);
            $errorNo = curl_errno($curl);

            throw new \RuntimeException($errorMsg, $errorNo);
        }

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ((200 > $code || $code >= 300) && 304 !== $code) {
            throw new \RuntimeException(sprintf('Url %s returned invalid code %s', $this->url, $code));
        }

        curl_close($curl);

        return self::getLastResponse($data);
    }

    /**
     * @param bool $ignoreErrors
     */
    public function setIgnoreErrors(bool $ignoreErrors): void
    {
        $this->ignoreErrors = $ignoreErrors;
    }

    /**
     * @return bool
     */
    public function getIgnoreErrors(): bool
    {
        return $this->ignoreErrors;
    }

    /**
     * @param int $maxRedirects
     */
    public function setMaxRedirects($maxRedirects): void
    {
        $this->maxRedirects = $maxRedirects;
    }

    /**
     * @return int
     */
    public function getMaxRedirects(): int
    {
        return $this->maxRedirects;
    }

    /**
     * @param int $maxRedirects
     */
    public function setTimeout($timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param string $response
     *
     * @return string
     */
    protected static function getLastResponse(string $response): string
    {
        $parts = preg_split('/((?:\\r?\\n){2})/', $response, -1, PREG_SPLIT_DELIM_CAPTURE);
        for ($i = count($parts) - 3; $i >= 0; $i -= 2) {
            if (0 === stripos($parts[$i], 'http')) {
                return implode('', array_slice($parts, $i));
            }
        }

        return $response;
    }
}
