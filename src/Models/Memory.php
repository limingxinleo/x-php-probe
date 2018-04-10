<?php
// +----------------------------------------------------------------------
// | Memory.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\Models;

class Memory extends Model
{
    public $total;

    public $free;

    public $buffers;

    public $cached;

    public $used;

    public $percent;

    public $cachedPercent;

    /**
     * Memory constructor.
     * @param $total
     * @param $free
     * @param $buffers
     * @param $cached
     * @param $used
     * @param $percent
     * @param $cachedPercent
     */
    public function __construct($total, $free, $buffers, $cached, $used, $percent, $cachedPercent)
    {
        $this->total = $total;
        $this->free = $free;
        $this->buffers = $buffers;
        $this->cached = $cached;
        $this->used = $used;
        $this->percent = $percent;
        $this->cachedPercent = $cachedPercent;
    }
}