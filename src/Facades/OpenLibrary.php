<?php

namespace ShiranSE\OpenLibrary\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ShiranSE\OpenLibrary\OpenLibrary
 */
class OpenLibrary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ShiranSE\OpenLibrary\OpenLibrary::class;
    }
}
