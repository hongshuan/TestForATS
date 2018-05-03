<?php

namespace Common;

class Logger
{
    protected $filename;

    public function __construct()
    {
        $this->filename = __DIR__ . '/../var/logs/app.log';
    }

    public function write($string)
    {
        error_log($string.PHP_EOL, 3, $this->filename);
    }
}
