<?php

namespace Sse\OpenLibrary;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class OpenLibrary
{
    const BASE_URL = 'https://openlibrary.org/';

    public function searchAuthor(string $query) : Collection {
        $results = $this->openLibraryHttpGetRequest('search/authors.json', ['q' => $query]);
        $result = $results->object();

        if($result->numFound > 0) {
            return collect($result->docs)->map(function ($author) {
                return [
                    'key' => $author->key,
                    'name' => $author->name,
                ];
            });
        }

        return collect();
    }

    private function openLibraryHttpGetRequest($path, $params) : Response {
        $response = Http::withHeaders(['Accept' => 'application/json'])->get(self::BASE_URL.$path, $params);

        if($response->ok()) {
            return $response;
        } else {
            throw new Exception('Open Library API request error!');
        }
    }
}
