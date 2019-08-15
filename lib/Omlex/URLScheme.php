<?php

namespace Omlex;

/**
 * URL scheme class.
 */
class URLScheme
{
    const WILDCARD_CHARACTER = '*';

    /**
     * The scheme.
     *
     * @var string
     */
    protected $scheme;

    /**
     * The generated pattern from the scheme.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Constructor.
     *
     * @param string $scheme The URL scheme
     *
     * @throws \InvalidArgumentException If the scheme is empty
     */
    public function __construct(string $scheme)
    {
        if (!is_string($scheme)) {
            throw new \InvalidArgumentException('The scheme cannot be empty.');
        }

        $this->scheme = $scheme;
    }

    /**
     * Require a sane __toString for all components.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->scheme;
    }

    /**
     * Check whether the given URL match the scheme.
     *
     * @param string $url The URL to check against
     *
     * @return bool True if match, false if not
     */
    public function match(string $url): bool
    {
        if (!$this->pattern) {
            $this->pattern = self::buildPatternFromScheme($this);
        }

        return (bool) preg_match($this->pattern, $url);
    }

    /**
     * Builds pattern from scheme.
     *
     * @return string
     */
    protected static function buildPatternFromScheme(URLScheme $scheme): string
    {
        // generate a unique random string
        $uniq = md5(mt_rand());

        // replace the wildcard sub-domain if exists
        $scheme = str_replace(
            '://'.self::WILDCARD_CHARACTER.'.',
            '://'.$uniq,
            $scheme->__toString()
        );

        // replace the wildcards
        $scheme = str_replace(
            self::WILDCARD_CHARACTER,
            $uniq,
            $scheme
        );

        // set the pattern wrap
        $wrap = '|';

        // quote the pattern
        $pattern = preg_quote($scheme, $wrap);

        // replace the unique string by the character class
        $pattern = str_replace($uniq, '.*', $pattern);

        return $wrap.$pattern.$wrap.'iu';
    }
}
