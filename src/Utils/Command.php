<?php
// +----------------------------------------------------------------------
// | Command.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\Utils;

class Command
{
    public static function get($args = '', $commandName = 'sysctl', $option = '-n')
    {
        if (false === ($commandPath = static::find($commandName))) return false;

        if ($command = shell_exec("$commandPath $option $args")) {
            return trim($command);
        }
        return false;
    }

    public static function find($commandName)
    {
        {
            $paths = ['/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin'];

            foreach ($paths as $path) {
                if (is_executable("$path/$commandName")) return "$path/$commandName";
            }
            return false;
        }
    }
}