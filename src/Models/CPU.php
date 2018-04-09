<?php
// +----------------------------------------------------------------------
// | CPU.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\Models;

class CPU extends Model
{
    public $core;

    public $processor;

    public $cores;

    public $model;

    public function __construct($core, $processor, $cores, $model)
    {
        $this->core = $core;
        $this->processor = $processor;
        $this->cores = $cores;
        $this->model = $model;
    }
}