<?php

namespace ShiranSE\OpenLibrary;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use ShiranSE\OpenLibrary\Classes\OpenLibraryAuthor;
use ShiranSE\OpenLibrary\Classes\OpenLibraryWork;

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
                    ->setBirthDate($author->birth_date ?? '')
                    ->setTopSubjects(isset($author->top_subjects) ? collect($author->top_subjects) : collect())
                    ->setTopWork($author->top_work ?? '')
                    ->setWorkCount($author->work_count)
                    ->setMeta($author);
            });
        }

        return collect();
    }

    /**
     * Search for works by a given query
     *
     * @param  string  $query
     */
    public function searchWorks(string $title, int $pageSize = 5) : Collection {
        $results = $this->openLibraryHttpGetRequest('search.json', ['title' => $title, 'limit' => $pageSize]);
        $result = $results->object();

        if ($result->numFound > 0) {
            return collect($result->docs)->map(function ($work) {
                if(isset($work->author_key)) {
                    return (new OpenLibraryWork(
                            $work->key, 
                            $work->title, 
                            $work->author_key[0]
                        )
                    )->setMeta($work)
                    ->setEditionCount($work->edition_count)
                    ->setEditionKeys(isset($work->edition_key)? collect($work->edition_key) : collect())
                    ->setCover('https://covers.openlibrary.org/a/id/'.$work->cover_i.'-M.jpg');
                }
            });
        }

        return collect();
    }

    /**
     * Retrieve an author by a given key
     */
    public function getAuthor(string $key): OpenLibraryAuthor
    {
        $results = $this->openLibraryHttpGetRequest('authors/'.$key);
        $result = $results->object();

        if(isset($result->key)) {
            $author = (new OpenLibraryAuthor($result->key, $result->name))
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
            }))
            ->setMeta($result);

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

        /**
     * Retrieve an author by a given key
     *
     * @param string $key
     * @return OpenLibraryWork
     */
    public function getWork(string $key): OpenLibraryWork
    {
        $results = $this->openLibraryHttpGetRequest('works/'.$key);
        $result = $results->object();

        if(isset($result->key)) {
            return (new OpenLibraryWork($result->key, $result->title, $result->author_key[0]))
            ->setMeta($result)
            ->setDescription($result->description ?? '')
            ->setEditionCount($result->edition_count)
            ->setEditionKeys(isset($result->edition_key)? collect($result->edition_key) : collect())
            ->setCover('https://covers.openlibrary.org/a/id/'.$result->cover_i.'-M.jpg');
        }

        throw new Exception('Work not found for given key : '.$key);
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
