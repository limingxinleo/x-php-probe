<?php
// +----------------------------------------------------------------------
// | Darwin.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Probe\OS;

use Xin\Probe\Exceptions\CpuCoreException;
use Xin\Probe\Models\CPU as CPUModel;
use Xin\Probe\Utils\Command;
use Xin\Probe\Utils\Size;
use Xin\Traits\Common\InstanceTrait;

class Darwin extends CPU implements OSInterface
{
    use InstanceTrait;

    protected function initCPU(): CPUModel
    {
        $core = Command::get("machdep.cpu.core_count");
        if (false === $core) {
            throw new CpuCoreException('无法正确获取CPU核数');
        }
        $processor = Command::get("machdep.cpu.thread_count");
        $cores = $core . '核' . ($core ? '/' . $processor . '线程' : '');
        $model = Command::get("machdep.cpu.brand_string");
        $cache = Command::get("machdep.cpu.cache.size") * $core;
        $model = $model . ' [二级缓存：' . $cache . ']';

        return new CPUModel($core, $processor, $cores, $model);
    }

    protected function initUptime(): string
    {
        // 获取服务器运行时间
        $uptime = Command::get("kern.boottime");
        preg_match_all('#(?<={)\s?sec\s?=\s?+\d+#', $uptime, $matches);
        $_uptime = explode('=', $matches[0][0])[1];

        $str = time() - $_uptime;
        $min = $str / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $uptime = $days . "天";
        if ($hours !== 0) $uptime .= $hours . "小时";
        $uptime .= $min . "分钟";
        return $uptime;
    }

    public function svr_darwin()
    {


        // 获取内存信息
        if (false === ($mTatol = Command::get("hw.memsize"))) return false;
        $vmstat = Command::get("", 'vm_stat', '');
        if (preg_match('/^Pages free:\s+(\S+)/m', $vmstat, $mfree)) {
            if (preg_match('/^File-backed pages:\s+(\S+)/m', $vmstat, $mcache)) {
                // OS X 10.9 or never
                $mFree = $mfree[1] * 4 * 1024;
                $mCached = $mcache[1] * 4 * 1024;
                if (preg_match('/^Pages occupied by compressor:\s+(\S+)/m', $vmstat, $mbuffer)) {
                    $mBuffer = $mbuffer[1] * 4 * 1024;
                }
            } else {
                if (preg_match('/^Pages speculative:\s+(\S+)/m', $vmstat, $spec_buf)) {
                    $mFree = ($mfree[1] + $spec_buf[1]) * 4 * 1024;
                } else {
                    $mFree = $mfree[1] * 4 * 1024;
                }
                if (preg_match('/^Pages inactive:\s+(\S+)/m', $vmstat, $inactive_buf)) {
                    $mCached = $inactive_buf[1] * 4 * 1024;
                }
            }
        } else {
            return false;
        }
        $mUsed = $mTatol - $mFree;

        $res['mTotal'] = Size::format($mTatol, 1);
        $res['mFree'] = Size::format($mFree, 1);
        $res['mBuffers'] = Size::format($mBuffer, 1);
        $res['mCached'] = Size::format($mCached, 1);
        $res['mUsed'] = Size::format($mUsed, 1);
        $res['mPercent'] = (floatval($mTatol) != 0) ? round($mUsed / $mTatol * 100, 1) : 0;
        $res['mCachedPercent'] = (floatval($mCached) != 0) ? round($mCached / $mTatol * 100, 1) : 0; //Cached内存使用率

        $swapInfo = Command::get("vm.swapusage");
        $swap1 = preg_split('/M/', $swapInfo);
        $swap2 = preg_split('/=/', $swap1[0]);
        $swap3 = preg_split('/=/', $swap1[1]);
        $swap4 = preg_split('/=/', $swap1[2]);

        $sTotal = $swap2[1] * 1024 * 1024;
        $sUsed = $swap3[1] * 1024 * 1024;
        $sFree = $swap4[1] * 1024 * 1024;

        $res['swapTotal'] = Size::format($sTotal, 1);
        $res['swapFree'] = Size::format($sFree, 1);
        $res['swapUsed'] = Size::format($sUsed, 1);
        $res['swapPercent'] = (floatval($sTotal) != 0) ? round($sUsed / $sTotal * 100, 1) : 0;

        $res['mBool'] = true;
        $res['cBool'] = true;
        $res['rBool'] = false;
        $res['sBool'] = true;

        // CPU状态
        $cpustat = Command::get(1, 'sar', '');
        if ($cpustat !== false) {
            preg_match_all("/Average\s{0,}\:+\s+\w+\s+\w+\s+\w+\s+\w+/s", $cpustat, $_cpu);
            $_cpu = preg_split("/\s+/", $_cpu[0][0]);
            $percent = $_cpu[1] + $_cpu[2] + $_cpu[3];
            $res['cpu']['percent'] = $percent;
        }

        return $res;
    }
}