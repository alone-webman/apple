# 生成ios描述文件

### 安装

```text
composer require alone-webman/apple
```

### 使用方法

* 直接传配置和使用方法二选一

```php
[
    //APP名称
    'title'       => 'App',

    //APP图标(绝对路径)
    'icon'        => __DIR__ . '/apple.png',

    //APP网站
    'url'         => 'https://www.apple.com.cn/',

    //是否全屏显示
    'screen'      => true,

    //是否可移除
    'move'        => true,

    //版本号
    'version'     => '1',

    //唯一ID,为空随机
    'build'       => '',

    //描述(显示在APP描述文件里面),可使用%title%获取名称
    'description' => '请点击右上角的"安装",这将会把"%title%"添加到您的主屏上',

    //标签(显示在描述文件APP名称下方),可使用%title%获取名称
    'label'       => '%title%',

    //保存目录(绝对路径),为空不保存
    'save'        => __DIR__ . '/ssl',

    //证书签名设置 -- 可选
    'ssl'         => [
        //域名证书路径
        'domain'  => '',
        //域名私钥路径
        'private' => ''
    ]
]
```

```php
<?php
$apple = alone_apple('array配置');
$apple->title('APP名称');
$apple->icon('APP图标(绝对路径)');
$apple->url('APP网站');
$apple->screen(true);
$apple->move(true);
$apple->version("1");
$apple->build('');
$apple->description("描述");
$apple->label("标签");
$apple->save("保存目录(绝对路径)");
$apple->ssl("域名证书路径", "域名私钥路径");
$file = $apple->exec('保存文件名称', '是否ssl签名'); //执行
var_dump($file); //文件绝对路径
```

## 在webman中使用

* 使用此仓库要安装 https://www.workerman.net/doc/webman/plugin/console.html

```text
composer require webman/console
```

### 配置 `config/plugin/alone/apple/app.php`

```php
<?php
<?php
return [
    'enable' => true,
    /*
     * 是否开放下载链接
     */
    'down'   => true,
    /*
     * 支持请求方法 array 或者 string多个使用,号分开
     */
    'method' => 'get',
    /*
     * 下载路由
     * 配置名称 %name%
     */
    'path'   => 'down/apple/%name%/app',
    /*
     * 配置列表
     * php webman alone:apple [name]
     */
    'config' => [
        'demo' => [
            /*
             * APP名称
             */
            'title'       => 'Apple',
            /*
             * APP图标(绝对路径)
             */
            'icon'        => alone_dir_apple('file/apple.png'),
            /*
             * APP网站
             */
            'url'         => 'https://www.apple.com.cn/',
            /*
             * 是否全屏显示
             */
            'screen'      => true,
            /*
             * 是否可移除
             */
            'move'        => true,
            /*
             * 版本号
             */
            'version'     => 1,
            /*
             * 唯一ID,为空随机
             */
            'build'       => '',
            /*
             * 描述(显示在APP描述文件里面),可使用%title%获取名称
             */
            'description' => '请点击右上角的"安装",这将会把"%title%"添加到您的主屏上',
            /*
             * 标签(显示在描述文件APP名称下方),可使用%title%获取名称
             */
            'label'       => '%title%',
            /*
             * 保存目录(绝对路径),为空不保存
             */
            'save'        => base_path('runtime/alone/apple'),
            /*
             * 证书签名设置
             */
            'ssl'         => [
                //域名证书路径(绝对路径)
                'domain'  => '',
                //域名私钥路径(绝对路径)
                'private' => ''
            ]
        ]
    ]
];
  ```

### 命令 `php webman alone:apple [name]`

* [name]是config中的key
* 没有输入name默认第1个

```text
php webman alone:apple demo
```