<?php

namespace YogCloud\HyperfSoar;

use Guanguans\SoarPHP\Exceptions\InvalidArgumentException;
use Guanguans\SoarPHP\Exceptions\RuntimeException;
use Swoole\Coroutine\System;

trait Exec
{
    /**
     * @param  string  $command
     *
     * @throws \Guanguans\SoarPHP\Exceptions\InvalidArgumentException
     * @throws \Guanguans\SoarPHP\Exceptions\RuntimeException
     *
     * @return mixed
     */
    public function exec(string $command): string
    {
        if (!is_string($command)) {
            throw new InvalidArgumentException('Command type must be a string');
        }

        if (stripos($command, 'soar') === false) {
            throw new InvalidArgumentException(sprintf("Command error: '%s'", $command));
        }

        $result = System::exec($command);

        if ($result['code'] !== 0) {
            throw new RuntimeException(sprintf("Command error: '%s'", $result['output']));
        }

        return $result['output'];
    }
}