<?php

namespace AloneWebMan\Apple\Command;

use AloneWebMan\Apple\Facade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppleExec extends Command {
    protected static $defaultName        = 'alone:apple';
    protected static $defaultDescription = 'convert apple app <info>[name]</info>';

    protected function configure(): void {
        $this->addArgument('key', InputArgument::OPTIONAL, 'key'); //选择key
    }

    public function execute(InputInterface $input, OutputInterface $output): int {
        $key = $input->getArgument('key');
        static::execCommand($key);
        return self::SUCCESS;
    }

    public static function execCommand($key): void {
        $list = config('plugin.alone.apple.app.config', []);
        echo "--------------------------------------------------------\r\n";
        if (count($list) == 0) {
            echo "No config\r\n";
            echo "--------------------------------------------------------\r\n";
            return;
        }
        $show = "Opt key list:\r\n";
        foreach ($list as $k => $v) {
            $show .= "$k:{$v['title']}->{$v['url']}\r\n";
        }
        $key = !empty($key) ? $key : (count($list) == 1 ? key($list) : $key);
        if (empty($key) || !isset($list[$key])) {
            echo $show;
        } else {
            $config = $list[$key];
            $apple = (new Facade($config));
            echo $apple->exec($key, true) . "\r\n";
        }
        echo "--------------------------------------------------------\r\n";
    }
}