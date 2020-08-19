<?php

namespace App;

class Postcard
{
    public static function resolve_facade($name)
    {
//        dd(app()['PostcardSendingService']);
        // or
//        dd(app()->make('PostcardSendingService'));

        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        return self::resolve_facade('PostcardSendingService')->$method(...$arguments);
    }
}