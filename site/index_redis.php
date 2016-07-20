<?php
//连接本地的 Redis 服务
   $redis = new Redis();
   $redis->connect(redis, 6379);
   echo "Connection to server sucessfully";
   //存储数据到列表中
   $redis->lpush("tutorial-list", "Redis");
   $redis->lpush("tutorial-list", "Mongodb");
   $redis->lpush("tutorial-list", "Mysql");
   // 获取存储的数据并输出
   $arList = $redis->lrange("tutorial-list", 0 ,5);
   echo "Stored string in redis";
   print_r($arList);
?>