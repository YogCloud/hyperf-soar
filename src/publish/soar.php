<?php

declare(strict_types=1);

return [
    'enabled' => env('SOAR_ENABLED', env('APP_ENV') === 'local'),
    '-soar-path' => env('SOAR_PATH', ''), // soar 二进制文件的绝对路径
    '-test-dsn' => [
        'host' => env('SOAR_TEST_DSN_HOST', env('DB_HOST', '127.0.0.1')),
        'port' => env('SOAR_TEST_DSN_PORT', env('DB_PORT', 3306)),
        'dbname' => env('SOAR_TEST_DSN_DBNAME', env('DB_DATABASE', 'hyperf')),
        'username' => env('SOAR_TEST_DSN_USER', env('DB_USERNAME', '')),
        'password' => env('SOAR_TEST_DSN_PASSWORD', env('DB_PASSWORD', '')),
        'disable' => env('SOAR_TEST_DSN_DISABLE', false),
    ],
    '-sampling' => env('SOAR_SAMPLING', true),                       // 是否开启数据采样开关
    '-allow-drop-index' => env('SOAR_ALLOW_DROP_INDEX', true),       // 允许输出删除重复索引的建议
    '-drop-test-temporary' => env('SOAR_DROP_TEST_TEMPORARY', true), // 是否清理测试环境产生的临时库表
    '-log-output' => BASE_PATH . '/runtime/logs/soar.log',
];
