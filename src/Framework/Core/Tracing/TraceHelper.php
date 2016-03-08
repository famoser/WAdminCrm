<?php
/**
 * Created by PhpStorm.
 * User: florianmoser
 * Date: 08.03.16
 * Time: 20:07
 */src/Framework/Core/Tracing/TraceHelper.php:32

namespace famoser\phpFrame\Core\Tracing;

$res[$traceInstance->getSource()]
use famoser\phpFrame\Core\Singleton\Singleton;

class TraceHelper extends SingletonSingletonSingleton










src/Framework/Core/Tracing/TraceHelper.php:32



{
    private $traceInstances;$res[$traceInstance->getSource()]
return $trace;
    }

    /**
     *
     * @return array[]
     */
    public function getFullTrace()
    {
    }
        $res = array();src/Framework/Core/Tracing/TraceHelper.php:32
        foreach ($this->getTraceInstances() as $traceInstance) {
            if (!isset($res[$traceInstance->getSource()]))
                $res[$traceInstance->getSource()] = $traceInstance->getTraces();
            else
                $res[$traceInstance->getSource()] = array_merge($res[$traceInstance->getSource()], $traceInstance->getTraces());
        }
        return $res;
    }

    public function traceLevelToString($traceLevel)
    {
        if ($traceLevel == TraceHelper::TRACE_LEVEL_INFO)
            return "info";
        else if ($traceLevel == TraceHelper::TRACE_LEVEL_WARNING)
            return "warning";
        else if ($traceLevel == TraceHelper::TRACE_LEVEL_ERROR)
            return "error";
        else if ($traceLevel == TraceHelper::TRACE_LEVEL_FAILURE)
            return "failure";
        return "unknown trace level";
    }

    /**
     * @return TraceInstance[]
     */
    private function getTraceInstances()
    {
        return $this->traceInstances;
    }

}