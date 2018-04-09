<?php
// +----------------------------------------------------------------------
// | OS.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe;

use Xin\Traits\Common\InstanceTrait;

class OS
{
    use InstanceTrait;

    public $os;

    public $version;

    public $name;

    public function __construct()
    {
        $this->os = PHP_OS;
        $this->version = php_uname('r');
        $this->name = php_uname('n');
    }
}