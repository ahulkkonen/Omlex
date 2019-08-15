<?php

namespace Omlex\Component;

/**
 * Rich component.
 */
class Rich extends AbstractComponent
{
    protected $required = ['html', 'width', 'height'];

    /**
     * {@inheritdoc}
     */
    public function __toString(): ?string
    {
        return $this->html;
    }
}
