# automake-apk-php
win下php自动签名apk文件并且打包

##服务器安装php环境

* 下载 android-sdk-windows  下载JDK
* 打开zip支持 c:/windows/php.ini ,打开 exec
* apk 支持
* mime添加 .apk application/vnd.android.package-archive
* 安装javaSDK(要和android的编辑版本一致)
* 编辑IIS绑定权限(www:www) ,目录没有权限会导致生成失败

#####配置两个虚拟主机

* A:down.coolaj.cn  用于下载
* B:make.cookaj.cn  用于制作签名