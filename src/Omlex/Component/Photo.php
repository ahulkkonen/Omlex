<?php

namespace Omlex\Component;

class Photo extends AbstractComponent
{
    protected $required = ['url', 'width', 'height'];

    /**
     * {@inheritdoc}
     */
    public function __toString(): ?string
    {
        $title = $this->title ?? null;

        return sprintf('<img src="%s" width="%s" height="%s" alt="%s" />', $this->url, $this->width, $this->height, $title);
    }
}
