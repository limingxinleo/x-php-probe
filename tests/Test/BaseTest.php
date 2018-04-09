<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test;

use Tests\TestCase;
use Xin\Probe\OS;
use Xin\Probe\PHP\Extension;

class BaseTest extends TestCase
{
    public function testOs()
    {
        $os = OS::getInstance();
        dd(OS\Darwin::getInstance()->svr_darwin());
    }

    // public function testPhpExtension()
    // {
    //     $extension = Extension::getInstance();
    //     dd($extension);
    // }
}