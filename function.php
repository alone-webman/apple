<?php

use AloneWebMan\Apple\Routes;
use AloneWebMan\Apple\Facade;

/**
 * 生成ios描述文件
 * @param array $conf 配置
 * @return Facade
 */
function alone_apple(array $conf = []): Facade {
    return new Facade($conf);
}

/**
 * 下载路由
 * @return void
 */
function alone_apple_route(): void {
    Routes::down();
}

/**
 * 获取目录路径
 * @param string $path
 * @return string
 */
function alone_dir_apple(string $path = '/'): string {
    return __DIR__ . '/' . trim($path, '/');
}