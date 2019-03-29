# 阿里巴巴nacos配置中心-PHP客户端

### 特性

1. 容错兜底
2. 容易上手
3. 技术支持，有问题可加作者微信: suxiaolinKing

## composer安装

``` bash
composer require alibaba/nacos
```

## 使用crontab拉取配置文件

定时1分钟拉取一次

```bash
*/1 * * * * php path/to/cron.php
```

```php
# cron.php
Nacos::init(
    "http://127.0.0.1:8848/",
    "dev",
    "LARAVEL",
    "DEFAULT_GROUP",
    ""
)->runOnce();
```

拉取到的配置文件路径：当前工作目录/nacos/config/dev_nacos/snapshot/LARAVEL

配置文件保存的工作目录可以通过下面命令修改

```php
NacosConfig::setSnapshotPath("指定存放配置文件的目录路径");
```

## 长轮询拉取配置文件

```php
Nacos::init(
    "http://127.0.0.1:8848/",
    "dev",
    "LARAVEL",
    "DEFAULT_GROUP",
    ""
)->listener();
```
