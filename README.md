# yii2-ip-access IP访问限制


## Installation

```
composer require trylife/yii2-ip-access
```
## Configure

### 迁移数据

```
./yii migrate --migrationPath=@vendor/trylife/yii2-ip-access/migrations
```

### 配置模块

```
'modules' => [
    ...
    'ip-access' => [
        'class' => 'trylife\ipAccess\Module',
        'controllerMap' => [
            'ping' => [
                'class' => 'trylife\ipAccess\controllers\PingController',
                'accessKey' => 'jGajhDpsy2kKqDslFNcFt0zNF17BYqnT',
            ],
        ],
    ],
    ...
],
```

### crontab 定时访问

```
curl yourDomain/ip-access/ping/ping?accessKey=jGajhDpsy2kKqDslFNcFt0zNF17BYqnT
```

### 白名单访问控制
```
    'as IpWhiteListBehavior' => [
        'class' => 'trylife\ipAccess\behaviors\IpWhiteListBehavior',
        'open' => true,
        'allowIps' => [
            '127.0.0.1',
        ],
        'allowRoutes' => [
            'ip-access/ping/ping'
        ],
    ],
```
