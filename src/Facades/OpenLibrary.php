<?php

namespace Sse\OpenLibrary\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sse\OpenLibrary\OpenLibrary
 */
class OpenLibrary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Sse\OpenLibrary\OpenLibrary::class;
    }
}
