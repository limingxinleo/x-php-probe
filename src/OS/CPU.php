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
    /** @var CPUModel */
    public $cpu;

    public $uptime;

    public $memory;

    public function __construct()
    {
        $this->cpu = $this->initCPU();
        $this->uptime = $this->initUptime();
    }

    abstract protected function initCPU(): CPUModel;

    abstract protected function initUptime(): string;
}