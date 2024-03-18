<?php

namespace Sse\OpenLibrary\Classes;

use Illuminate\Support\Collection;
use Sse\OpenLibrary\Facades\OpenLibrary;
use Sse\OpenLibrary\Traits\HasMetaFields;

class OpenLibraryWork
{
    use HasMetaFields;

    protected string $key;

    protected string $title;
    protected string $authorKey;
    protected string $description;

    protected string $cover;

    protected int $editionCount = 0;
    protected Collection $editionKeys;

    protected OpenLibraryAuthor $author;

    public function __construct(string $key, string $title, string $authorKey)
    {
        $this->key = $key;
        $this->title = $title;
        $this->authorKey = $authorKey;

        $this->editionKeys = collect();
        $this->description = '';
    }

    public function getAuthor(): OpenLibraryAuthor
    {
        if(isset($this->author)) {
            return $this->author;
        }

        $this->author = OpenLibrary::getAuthor($this->authorKey);
        return $this->author;
    }

    public function setAuthor(OpenLibraryAuthor $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getEditionCount(): int
    {
      return $this->editionCount; 
    }
  
    public function setEditionCount(int $editionCount): self
    {
      $this->editionCount = $editionCount;
  
      return $this;
    }
  
    public function getEditionKeys(): Collection
    {
      return $this->editionKeys;
    }
  
    public function setEditionKeys(Collection $editionKeys): self 
    {
      $this->editionKeys = $editionKeys;
      
      return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        if(is_object($description)) {
            $this->description = $description->value;
        }
        else {
            $this->description = $description;
        }

        return $this;
    }
}
