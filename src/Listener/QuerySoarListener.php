<?php

namespace YogCloud\HyperfSoar\Listener;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use YogCloud\HyperfSoar\Soar;

#[Listener]
class QuerySoarListener implements ListenerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var StdoutLoggerInterface
     */
    private $console;

    /**
     * @var Soar
     */
    private $soar;

    /**
     * @var bool
     */
    protected $soarIsEnabled;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('soar');
        $this->console = $container->get(StdoutLoggerInterface::class);
        $this->soar = $container->get(Soar::class);
        $this->soarIsEnabled = $container->get(ConfigInterface::class)->get('soar.enabled');
    }

    public function listen(): array
    {
        return [
            QueryExecuted::class,
        ];
    }

    /**
     * @param QueryExecuted $event
     */
    public function process(object $event)
    {
        if ($event instanceof QueryExecuted && $this->soarIsEnabled) {
            $sql = $event->sql;
            if (!Arr::isAssoc($event->bindings)) {
                foreach ($event->bindings as $key => $value) {
                    $sql = Str::replaceFirst('?', "'{$value}'", $sql);
                }
            }
            $soar = $this->soar->jsonScore($sql);
            $this->logger->info(sprintf("%s", $soar));
        }
    }
}