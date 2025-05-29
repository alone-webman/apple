<?php

namespace AloneWebMan\Apple;

use Webman\Route;

class Routes {

    /**
     * 下载apple路由
     * @return void
     */
    public static function down(): void {
        if (!empty(config('plugin.alone.apple.app.down'))) {
            $config = config('plugin.alone.apple.app.config');
            if (!empty($config)) {
                $method = config('plugin.alone.apple.app.method');
                if (!empty($method)) {
                    $paths = [];
                    $method = array_map('strtoupper', is_array($method) ? $method : explode(',', $method));
                    $path = config('plugin.alone.apple.app.path');
                    if (!empty($path)) {
                        foreach ($config as $name => $conf) {
                            if (!in_array($name, $paths)) {
                                $paths[] = $name;
                                Route::add($method, "/" . trim(str_replace('%name%', $name, $path), '/'), function() use ($name, $conf) {
                                    return static::apple($name, $conf);
                                })->name('down.apple');
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * 下载apple
     * @param string|int $name
     * @param array      $conf
     * @return mixed
     */
    protected static function apple(string|int $name, array $conf): mixed {
        if (!empty($conf)) {
            $file = Way::dirPath(($conf['save'] ?? ''), "$name.mobileconfig");
            if (!is_file($file)) {
                $apple = new Facade($conf);
                $file = $apple->exec($name);
            }
            if (!empty($file)) {
                return response($file)->withHeaders([
                    'Content-Type'        => "application/x-apple-aspen-config",
                    'Content-Disposition' => "attachment; filename=$name.mobileconfig"
                ]);
            }
        }
        return response(Way::errHtml());
    }
}