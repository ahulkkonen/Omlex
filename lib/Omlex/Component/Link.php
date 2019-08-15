<?php

namespace Omlex\Component;

/**
 * Link component.
 */
class Link extends AbstractComponent
{
    /**
     * {@inheritdoc}
     */
    public function __toString(): ?string
    {
        return sprintf('<a href="%s">%s</a>', $this->url, $this->title);
    }
}
