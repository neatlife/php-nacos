# 服务发现

## 配置
```php
NacosConfig::setHost("http://127.0.0.1:8848/"); // 配置中心地址
$discovery = Discovery::init(
    "nacos.test.1",
    "11.11.11.11",
    "8848"
);
```

## 注册实例

```php
$discovery->register();
```

## 删除实例
```php
$discovery->delete();
```

## 修改实例
```php
$discovery->update(0.8);
```

## 查询实例列表

```php
$instanceList = $discovery->listInstances();
```

## 查询实例详情
```php
$instance = $discovery->get();
```

## 发送实例心跳

```php
$beat = $discovery->beat();
```

定时5秒发送一次心跳

```bash
#!/bin/bash

while true; do
  php path/to/beat.php
  sleep 5;
done
```
