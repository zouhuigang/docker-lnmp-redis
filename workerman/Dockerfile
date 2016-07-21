#workerman 聊天服务器的镜像
FROM registry.aliyuncs.com/acs-sample/ubuntu:14.04

RUN apt-get update \
	&&apt-get -y  install php5-cli git gcc php-pear php5-dev libevent-dev  \
	&&pecl install channel://pecl.php.net/libevent-0.1.0  \
	&&echo extension=libevent.so > /etc/php5/cli/conf.d/libevent.ini \
	&&git clone https://github.com/walkor/Workerman \
	&&git clone https://git.coding.net/zouhuigang/workerman-todpole.git \
	&& cd workerman-todpole \
CMD php start.php start -d	
EXPOSE 8383
EXPOSE 3232