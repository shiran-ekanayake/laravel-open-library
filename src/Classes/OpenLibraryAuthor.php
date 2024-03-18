<?php

namespace Sse\OpenLibrary\Classes;

use Illuminate\Support\Collection;
use Sse\OpenLibrary\Traits\HasMetaFields;

class OpenLibraryAuthor
{
    use HasMetaFields;

    protected string $key;

    protected string $name;

    protected string $title = '';

    protected string $bio = '';

    protected string $personalName = '';

    protected Collection $alternateNames;

    protected string $birthDate = '';

    protected string $deathDate = '';

    protected string $period = '';

    protected string $wikipeadiaLink = '';

    protected Collection $links;

    protected Collection $photos;

    protected string $topWork = '';

    protected int $workCount = 0;

    protected Collection $topSubjects;

    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
        $this->alternateNames = collect();
        $this->links = collect();
        $this->photos = collect();
        $this->topSubjects = collect();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string|object $bio): self
    {
        if(is_object($bio)) {
            $this->bio = $bio->value;
        }
        else {
            $this->bio = $bio;
        }

        return $this;
    }

    public function getPersonalName(): string
    {
        return $this->personalName;
    }

    public function setPersonalName(string $personalName): self
    {
        $this->personalName = $personalName;

        return $this;
    }

    public function getAlternateNames(): Collection
    {
        return $this->alternateNames;
    }

    public function setAlternateNames(Collection $alternateNames): self
    {
        $this->alternateNames = $alternateNames;

        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getDeathDate(): string
    {
        return $this->deathDate;
    }

    public function setDeathDate(string $deathDate): self
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    public function getPeriod(): string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getWikipeadiaLink(): string
    {
        return $this->wikipeadiaLink;
    }

    public function setWikipeadiaLink(string $wikipeadiaLink): self
    {
        $this->wikipeadiaLink = $wikipeadiaLink;

        return $this;
    }

    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function setLinks(Collection $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function setPhotos(Collection $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getTopWork(): string
    {
        return $this->topWork;
    }

    public function setTopWork(string $topWork): self
    {
        $this->topWork = $topWork;

        return $this;
    }

    public function getWorkCount(): int
    {
        return $this->workCount;
    }

    public function setWorkCount(int $workCount): self
    {
        $this->workCount = $workCount;

        return $this;
    }

    public function getTopSubjects(): Collection
    {
        return $this->topSubjects;
    }

    public function setTopSubjects(Collection $topSubjects): self
    {
        $this->topSubjects = $topSubjects;

        return $this;
    }
}
