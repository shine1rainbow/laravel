The project is for Mastiff.

## 1. 快速开始

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

## 2. 环境需求

What things you need to install the software and how to install them

```
apache2.4+/nginx1.10.+, php7.0+, mysql5.7+, redis3.2+

* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Swoole PHP Extension
* Redis PHP Extension
```

## 3. 快速部署

A step by step series of examples that tell you have to get a development env running

Say what the step will be

### 3.1 拷贝项目
```
git clone https://github.com/shine1rainbow/laravel.git
```

### 3.2 安装必须软件
```
composer install
```

### 3.3 修改配置文件,配置Mysql信息配置
```
cp .env.example .env && vi .env
```

### 3.4 配置域名白名单(将前端URL写入文件)
```
vi config/cors.php
```

## 4. Built With

* [Laravel](https://laravel.com/docs/5.5) - The web framework used

## 5. License

This project is licensed under the Apache License - see the [LICENSE.md](LICENSE.md) file for details
