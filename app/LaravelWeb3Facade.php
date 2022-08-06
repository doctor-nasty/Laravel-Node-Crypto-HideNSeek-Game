<?php

namespace App\Http;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sawirricardo\LaravelWeb3\LaravelWeb3
 */
class LaravelWeb3Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-web3';
    }
}