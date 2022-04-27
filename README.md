# Hyperf-soar
> soar 是一个小米公司开源的 soar 开发的 SQL 优化器、重写器(辅助 SQL 调优)。

[![Latest Stable Version](http://poser.pugx.org/yogcloud/hyperf-soar/v)](https://packagist.org/packages/yogcloud/hyperf-soar) [![Total Downloads](http://poser.pugx.org/yogcloud/hyperf-soar/downloads)](https://packagist.org/packages/yogcloud/hyperf-soar) [![Latest Unstable Version](http://poser.pugx.org/yogcloud/hyperf-soar/v/unstable)](https://packagist.org/packages/yogcloud/hyperf-soar) [![License](http://poser.pugx.org/yogcloud/hyperf-soar/license)](https://packagist.org/packages/yogcloud/hyperf-soar) [![PHP Version Require](http://poser.pugx.org/yogcloud/hyperf-soar/require/php)](https://packagist.org/packages/yogcloud/hyperf-soar)

# 环境要求
- Hyperf 2.2
- Swoole 4.6
- ext-json
- ext-mbstring
- ext-pdo

# 安装
```
composer require yogcloud/hyperf-soar
```

# 发布文件
```
php bin/hyperf.php vendor:publish yogcloud/hyperf-soar
```

# 配置文件

```php
SOAR_ENABLED=true
SOAR_TEST_DSN_DISABLE=false
SOAR_PATH=your_soar_path
SOAR_TEST_DSN_HOST=127.0.0.1
SOAR_TEST_DSN_PORT=3306
SOAR_TEST_DSN_DBNAME=yourdb
SOAR_TEST_DSN_USER=root
SOAR_TEST_DSN_PASSWORD=
SOAR_REPORT_TYPE=json
```

# 使用
执行查询日志生成到`runtime/logs/xxx.log`
```json
[2022-04-25 04:06:03] soar.INFO: [
 {
  "ID": "2E5B1F825CF2009A",
  "Fingerprint": "select * from `kd_farm_account` where `kd_farm_account`.`user_id` = ? limit ?",
  "Score": 75,
  "Sample": "select * from `kd_farm_account` where `kd_farm_account`.`user_id` = '500' limit 1",
  "Explain": null,
  "HeuristicRules": [
    {
      "Item": "COL.001",
      "Severity": "L1",
      "Summary": "不建议使用 SELECT * 类型查询",
      "Content": "当表结构变更时，使用 * 通配符选择所有列将导致查询的含义和行为会发生更改，可能导致查询返回更多的数据。",
      "Case": "select * from tbl where id=1",
      "Position": 0
    },
    {
      "Item": "RES.002",
      "Severity": "L4",
      "Summary": "未使用 ORDER BY 的 LIMIT 查询",
      "Content": "没有 ORDER BY 的 LIMIT 会导致非确定性的结果，这取决于查询执行计划。",
      "Case": "select col1,col2 from tbl where name=xx limit 10",
      "Position": 0
    }
  ],
  "IndexRules": null,
  "Tables": [
    "`information_schema`.`kd_farm_account`"
  ]
} 
]
 [] []

```

# License
Apache License Version 2.0, http://www.apache.org/licenses/