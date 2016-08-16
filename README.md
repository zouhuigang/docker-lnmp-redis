##环境配置##

sudo yum update


安装docker链接：
https://docs.docker.com/engine/installation/linux/centos/

##安装python3.5以上版本：

查看python版本

python --version


1、CentOS6.5/7 安装Python 的依赖包

yum groupinstall "Development tools"

yum install zlib-devel bzip2-devel openssl-devel ncurses-devel sqlite-devel readline-devel tk-devel gdbm-devel db4-devel libpcap-devel xz-devel

2、下载Python3.6的源码包并编译

wget http://mirrors.sohu.com/python/3.6.0/Python-3.6.0a2.tgz

tar xf Python-3.6.0a2.tgz

cd Python-3.6.0a2

./configure --prefix=/usr/local --enable-shared

make

make install

进入/usr/local/bin里面，输入命令，如果/usr/bin目录有python连接，则删除：

ln –s /usr/local/bin/python3 /usr/bin/python

3、在运行Python之前需要配置库：

echo /usr/local/lib >> /etc/ld.so.conf.d/local.conf

ldconfig

4、运行演示：

python3 --version

Python 3.6.0a2



##yum命令会受影响
[root@nginx ~]# vi /usr/bin/yum    #将!/usr/bin/python改成!/usr/bin/python2即可。

File "/usr/libexec/urlgrabber-ext-down"-------------报错

vi /usr/libexec/urlgrabber-ext-down

把头部的!#-----python改成和/usr/bin/yum中一样的




##安装pip

从pip官网 https://pypi.python.org/pypi/pip 下载pip的源代码

解压
tar -zxvf pip-8.1.2.tar.gz

cd pip-8.1.2

安装

python setup.py install


这个时候会报错说少了setuptools

从setuptools官网 https://pypi.python.org/pypi/setuptools下载setuptools原来

解压

tar -zxvf setuptools-24.0.3.tar.gz

cd setuptools-24.0.3

安装

python setup.py install


再次安装pip就OK了。



##安装docker-compose
参考资料：https://docs.docker.com/compose/install/

pip install docker-compose


##使用docker-compose构建docker-lnmp-redis-workerman
cd /mnt && mkdir gitcoding && cd gitcoding

git clone https://git.coding.net/zouhuigang/docker-lnmp-redis.git

cd docker-lnmp-redis && docker-compose build

docker-compose up -d

此时我们用docker ps -a可以看到启动了4个容器，发现一个mysql启动后退出了，检查问题发现site/mysqldata的文件拥有者是system。更改拥有者为root后，再次启动就正常了。注意mysqldata里面的文件拥有者也得更改为root





# LNMP Docker 配置文件

启动3个Docker：`php`, `mysql`, `nginx`。`nginx`连接 `php`，`php` 连接 `mysql`。

三个服务都可定制。

每个服务都有独立的文件夹存储其相关内容。

 - `nginx`： 存储 nginx 的默认站点配置文件：`default.conf`；
 - `mysql`： 存储 mysql 的配置文件 `mysql.cnf`；
 - `php`： 存储定制 php image 的 `Dockerfile`，以及`conf/php.conf`；

  官方的 php 是不带 mysql 插件的，因此需要使用 Dockerfile 进行定制。
  
#构建

docker-compose build


#目录说明
site/51tywy:为代码存放的目录--从宿主机挂载上容器
site/mysqldata:为数据库存放的目录--从宿主机挂载上容器
nginx mysql redis php分别为dockerfile存放的目录

mysql默认密码是51TYwy2016720,更改为：TYwy2016720

## 启动

```
docker-compose up -d
```

## 访问服务

`nginx` 将会守候 80 端口，直接在本机访问 http://localhost（如果是使用 Docker Toolbox 的虚拟机的话，http://192.168.99.100），其它环境请查询Docker主机IP。

```
curl http://localhost
```

测试是否安装成功,访问http://url/index_test.php
测试redis是否成功，访问http://url/index_redis.php

## 停止服务

```
docker-compose stop
```

## 新增自定义https说明文档 ##
docker-compose.yml：挂载证书目录到nginx中

##问题
Q:Data too long for column 'in_catestr' at row 1

A:找到docker-lnmp-redis\mysql下的文件mysql.cnf，
    sql_mode = NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES

  去掉STRICT_TRANS_TABLES，目前已去掉了，如需要，则根据自己需要添加