# personal-space
个人空间管理系统

# 更新记录
1.0.0、前后台模块初步搭建。(2017-12-6)

2.0.1、优化了最新评论的显示(按照 秒/分钟/小时/星期/月/年等)来显示。(2018-3-13)

2.0.2、增加了“整站搜索”、公告栏等功能。(2018-3-15)

2.0.3、优化了登录及注册界面，为用户登录新増“找回密码”等功能。(2018-3-16)

2.0.4、优化了后台菜单栏及新増“Banner管理”、“权限管理”等功能。(2018-3-19)

2.0.5、优化了前台登录注册响应样式，为注册时增加“验证码”判断输入框(防止恶意XSS攻击)。(2018-3-29)

# 安装

1、下载personal-space源码  [点击此处下载](https://codeload.github.com/baiyishaoxia/personal-space/zip/master)

2、解压到目录

3、配置web服务器(参见下面)

4、浏览器打开输入刚配置的域名地址访问即可

5、完成

* 配置web服务器(Apache)

```apache
  <VirtualHost *:80>
    ServerName www.personalspace.com
    DocumentRoot D:/php/personal-space
    <Directory  "D:/php/personal-space/">
      Options +Indexes +Includes +FollowSymLinks +MultiViews
      AllowOverride All
      Require local
    </Directory>
  </VirtualHost>
```
* 配置web服务器(Nginx)

```nginx
server {
    server_name  localhost;
    root   /path/php/personal-space;
    index  index.php index.html index.htm;
    try_files $uri $uri/ /index.php?$args;
    location ~ /api/(?!index.php).*$ {
       rewrite /api/(.*) /api/index.php?r=$1 last;
    }
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```
# 帮助
1、使用演示站点 演示站点前台 [进入personal-space](http://tzf.afu666.xyz:81)

2、联系方式 QQ群: 173335823

3、微信<br/>
![image](https://github.com/baiyishaoxia/personal-space/raw/option/screenshots/20180527012147.jpg)

4、谢谢你的支持<br/>
<img src="https://github.com/baiyishaoxia/personal-space/assets/34636159/f99a76d8-c765-4883-b812-4c74782b6baa" width="40%">


# 运行效果
![image](https://github.com/baiyishaoxia/personal-space/raw/option/screenshots/Home.jpg)
![image](https://github.com/baiyishaoxia/personal-space/raw/option/screenshots/Back.jpg)
![image](https://github.com/baiyishaoxia/personal-space/raw/option/screenshots/Back-auth.jpg)
# 特别鸣谢
wzz在后台时间搜索范围提供的建议和代码片段
