<?php

declare(strict_types=1);

namespace YogCloud\HyperfSoar;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'aspects' => [
            ],
            'dependencies' => [
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for soar.',
                    'source' => __DIR__ . '/publish/soar.php',
                    'destination' => BASE_PATH . '/config/autoload/soar.php',
                ],
            ],
        ];
    }
}