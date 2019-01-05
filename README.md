# 100Bits!  
100Bits 是一个公共画板。每个用户每天可以在画板上绘画 100个点。  
画板下的控制按钮可以追溯最近2个月来这幅画的绘画过程。  

网站地址: [https://lss233.com/games/100bits/](https://lss233.com/games/100bits/)  

## 本地运行
环境需求:  
* PHP >= 7.1  
* MySQL >= 5.6  
* Composer  

1. 克隆这个项目到本地  
2. 复制`.env.example`, 重命名为 `.env`  
3. 编辑`.env`文件，填写`DB_***` 等相关配置  
4. 运行:  
```bash
composer install
php artisan migrate
php artisan serve
```
接下来，您就可以在 [http://localhost:8000](http://localhost:8000)体验了！
## 开源协议
在[这里](LICENSE)浏览本项目的开源协议
