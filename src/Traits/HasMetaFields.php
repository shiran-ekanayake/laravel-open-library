<?php

namespace Sse\OpenLibrary\Traits;

trait HasMetaFields {

    protected ?object $meta = null;

    public function setMeta(?object $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    public function getMeta(): object
    {
        return $this->meta;
    }
}