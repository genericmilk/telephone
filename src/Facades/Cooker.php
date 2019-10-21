<?php

declare(strict_types=1);
namespace Genericmilk\Telephone\Facades;
use Illuminate\Support\Facades\Facade;

class Telephone extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Telephone';
    }
}
