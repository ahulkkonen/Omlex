<?php

namespace Omlex\Component;

/**
 * Video component.
 */
class Video extends AbstractComponent
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
