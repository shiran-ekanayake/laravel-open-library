<?php

namespace Sse\OpenLibrary;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Sse\OpenLibrary\Classes\OpenLibraryAuthor;

class OpenLibrary
{
    const BASE_URL = 'https://openlibrary.org/';

    /**
     * Search for authors by a given query
     */
    public function searchAuthors(string $query): Collection
    {
        $results = $this->openLibraryHttpGetRequest('search/authors.json', ['q' => $query]);
        $result = $results->object();

        if ($result->numFound > 0) {
            return collect($result->docs)->map(function ($author) {
                return (new OpenLibraryAuthor($author->key, $author->name))
                    ->setAlternateNames(isset($author->alternate_names) ? collect($author->alternate_names) : collect())
                    ->setBirthDate($result->birth_date ?? '')
                    ->setTopSubjects(isset($author->top_subjects) ? collect($author->top_subjects) : collect())
                    ->setTopWork($author->top_work ?? '')
                    ->setWorkCount($author->work_count);
            });
        }

        return collect();
    }

    /**
     * Retrieve an author by a given key
     *
     * @return array
     */
    public function getAuthor(string $key): OpenLibraryAuthor
    {
        $results = $this->openLibraryHttpGetRequest('authors/'.$key);
        $result = $results->object();

        if (isset($result->key)) {
            $author = (new OpenLibraryAuthor(str_replace('/authors/', '', $result->key), $result->name))
                ->setTitle($result->title ?? '')
                ->setBio($result->bio ?? '')
                ->setPersonalName($result->personal_name ?? '')
                ->setAlternateNames(isset($result->alternate_names) ? collect($result->alternate_names) : collect())
                ->setBirthDate($result->birth_date ?? '')
                ->setDeathDate($result->death_date ?? '')
                ->setPeriod($result->date ?? '')
                ->setWikipeadiaLink($result->wikipedia ?? '')
                ->setLinks(isset($result->links) ? collect($result->links) : collect())
                ->setPhotos(collect(isset($result->photos) ?? collect())->map(function ($photo) {
                    return 'https://covers.openlibrary.org/a/id/'.$photo.'-M.jpg';
                }));

            // Api does not provide some data returned by the search API, to include that data
            // call search API
            foreach ($this->searchAuthors($author->getName()) as $result) {
                if ($result->getKey() == $author->getKey()) {
                    $author->setTopSubjects($result->getTopSubjects());
                    $author->setTopWork($result->getTopWork());
                    $author->setWorkCount($result->getWorkCount());
                    break;
                }
            }

            return $author;
        }

        throw new Exception('Author not found for given key : '.$key);
    }

    private function openLibraryHttpGetRequest(string $path, array $params = []): Response
    {
        $response = Http::withHeaders(['Accept' => 'application/json'])->get(self::BASE_URL.$path, $params);

        if ($response->ok()) {
            return $response;
        } else {
            throw new Exception('Open Library API request error!');
        }
    }
}
