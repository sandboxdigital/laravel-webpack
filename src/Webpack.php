<?php

namespace Sandbox\Webpack;

class Webpack
{
    private static $_hot = false;

    public static function isHot()
    {
        return self::$_hot;
    }

    public static function setHot($hot)
    {
        return self::$_hot = $hot;
    }

    public static function hotUrl($path)
    {
        $host = config('webpack.host');
        $port = config('webpack.port');
        return $host.':'.$port.''.$path;
    }

}
