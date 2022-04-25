<?php

namespace YogCloud\HyperfSoar;

use Hyperf\Utils\Arr;

class Soar extends \Guanguans\SoarPHP\Soar
{
    use Exec;

    public function __construct(array $config = null)
    {
        $config = $config ?? config('soar');

        Arr::forget($config, 'enabled');
        Arr::set($config, '-report-type', 'json');
        parent::__construct($config);
    }
}