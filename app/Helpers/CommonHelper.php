<?php

namespace App\Helpers;

use App\Helpers\CommonHelper as CH;

class CommonHelper
{
    private static $e = [];

    public static function add($k, $v)
    {
        abort_if(key_exists($k, CH::$e), 409, 'Key exists!');
        CH::$e[$k] = $v;
        return $v;
    }

    public static function remove($k)
    {
        abort_if(!key_exists($k, CH::$e), 404, 'Key non-existent!');
        unset(CH::$e[$k]);
    }

    public static function get($k)
    {
        abort_if(!key_exists($k, CH::$e), 404, 'Key non-existent!');
        return CH::$e[$k];
    }

    public static function set($k, $v)
    {
        abort_if(!key_exists(CH::$e), 404, 'Key non-existent!');
        CH::$e[$k] = $v;
        return $v;
    }

    public static function safeadd($k, $v)
    {
        if(!key_exists($k, CH::$e)) {
            return CH::get($k);
        }
        CH::add($k, $v);
        return $v;
    }

    public static function saferemove($k)
    {
        if(key_exists($k, CH::$e)) {
            CH::remove($k);
        }
    }
}
