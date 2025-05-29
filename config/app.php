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
            'version'     => "1",
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