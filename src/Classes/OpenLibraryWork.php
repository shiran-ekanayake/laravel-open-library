<?php

namespace Sse\OpenLibrary\Classes;

use Sse\OpenLibrary\Traits\HasMetaFields;

class OpenLibraryWork
{
    use HasMetaFields;

    protected string $key;

    protected string $title;

    protected OpenLibraryAuthor $author;

    public function __construct(string $key, string $title, OpenLibraryAuthor $author)
    {
        $this->key = $key;
        $this->title = $title;
        $this->author = $author;
    }
}
