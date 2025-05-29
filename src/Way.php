<?php

namespace AloneWebMan\Apple;


class Way {
    /**
     * 生成13位时间
     * @param int|null|string $time
     * @param bool            $date
     * @return int
     */
    public static function getUnix(null|int|string $time = null, bool $date = false): int {
        if (!empty($time)) {
            return sprintf('%.6f', $date ? strtotime($time) : $time) * 1000;
        }
        [$t1, $t2] = explode(" ", microtime());
        return (int) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    /**
     * 生成Token
     * @return string
     */
    public static function getToken(): string {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    /**
     * 路径拼接,后面 不带 /
     * @param string $dir  绝对路径
     * @param string $path 相对路径
     * @return string
     */
    public static function dirPath(string $dir, string $path = ''): string {
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        $path = $path ? (($path == '/') ? $path : (DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR)) : DIRECTORY_SEPARATOR;
        return rtrim(rtrim($dir . $path, DIRECTORY_SEPARATOR), '/');
    }

    /**
     * 文件夹不存在创建文件夹(无限级)
     * @param $dir
     * @return bool
     */
    public static function mkDir($dir): bool {
        return (!empty(is_dir($dir)) || @mkdir($dir, 0777, true));
    }

    /**
     * 通过a.b.c.d获取数组内容
     * @param array|null      $array   要取值的数组
     * @param string|null|int $key     支持aa.bb.cc.dd这样获取数组内容
     * @param mixed           $default 默认值
     * @param string          $symbol  自定符号
     * @return mixed
     */
    public static function getArr(array|null $array, string|null|int $key = null, mixed $default = null, string $symbol = '.'): mixed {
        if (isset($key)) {
            if (isset($array[$key])) {
                $array = $array[$key];
            } else {
                $symbol = $symbol ?: '.';
                $arr = explode($symbol, trim($key, $symbol));
                foreach ($arr as $v) {
                    if (isset($v) && isset($array[$v])) {
                        $array = $array[$v];
                    } else {
                        $array = $default;
                        break;
                    }
                }
            }
        }
        return $array ?? $default;
    }

    /**
     * @param $file
     * @return false|string
     */
    public static function isFile($file): bool|string {
        return realpath($file);
    }

    /**
     * 替换内容
     * @param string|null $string 要替换的string
     * @param array       $array  ['key'=>'要替换的内容']
     * @param string      $symbol key前台符号
     * @return string
     */
    public static function tag(string|null $string, array $array = [], string $symbol = '%'): string {
        if (!empty($string)) {
            $array = array_combine(array_map(fn($key) => ($symbol . $key . $symbol), array_keys($array)), array_values($array));
            $result = strtr($string, $array);
            $result = preg_replace("/" . $symbol . "[^" . $symbol . "]+" . $symbol . "/", '', $result);
            $string = trim($result);
        }
        return $string ?? '';
    }

    /**
     * 报错html
     * @param int $status
     * @return string
     */
    public static function errHtml(int $status = 404): string {
        return "<html><head><title>$status Not Found</title></head><body><center><h1>$status Not Found</h1></center></body></html>";
    }
}