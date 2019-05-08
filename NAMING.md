# 服务发现

## 配置成客户端发送实例心跳
```php
NacosConfig::setHost("http://127.0.0.1:8848/"); // 配置中心地址
$naming = Naming::init(
    "nacos.test.1",
    "11.11.11.11",
    "8848"
);
```

## 配置成服务端检测实例是否存活
```php
NacosConfig::setHost("http://127.0.0.1:8848/"); // 配置中心地址
$naming = Naming::init(
    "nacos.test.1",
    "11.11.11.11",
    "8848",
    "",
    "",
    false
);
```
主要是最后一个参数需要置为false，设置后nacos服务器会自动检测ip和端口匹配的实例是否存活
设置后就无需客户端发送实例心跳了

## 注册实例

```php
$naming->register();
```

## 删除实例
```php
$naming->delete();
```

## 修改实例
```php
$naming->update(0.8);
```

## 查询实例列表

```php
$instanceList = $naming->listInstances();
```

## 查询实例详情
```php
$instance = $naming->get();
```

## 发送实例心跳

```php
$beat = $naming->beat();
```

定时5秒发送一次心跳

```bash
#!/bin/bash

while true; do
  php path/to/beat.php
  sleep 5;
done
```
