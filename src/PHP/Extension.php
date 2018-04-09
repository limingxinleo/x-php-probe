<?php
// +----------------------------------------------------------------------
// | Extension.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\PHP;

use Xin\Traits\Common\InstanceTrait;

class Extension
{
    use InstanceTrait;

    public $extensions = [];

    public function __construct()
    {
        $this->extensions = get_loaded_extensions();
    }
}