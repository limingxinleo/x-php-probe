<?php
// +----------------------------------------------------------------------
// | Model.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\Models;

use ArrayAccess;

abstract class Model implements ArrayAccess
{
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        return $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        return $this->$offset = null;
    }
}