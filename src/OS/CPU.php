<?php
// +----------------------------------------------------------------------
// | CPU.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\OS;

use Xin\Probe\Models\CPU as CPUModel;

abstract class CPU
{
    public $cpu;

    public function __construct()
    {
        $this->cpu = $this->initCPU();
    }

    public function getCPU()
    {
        return $this->cpu;
    }

    abstract protected function initCPU(): CPUModel;
}