<?php
namespace Configs;

class Url
{
    public static function redirecionar($url)
    {
        sleep(1);
        header('Location:'.DIRPAGE.$url);
    }
}