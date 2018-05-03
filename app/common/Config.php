<?php

namespace App\Common;

/**
 * Config class
 *
 * load configuration from ini file
 */
class Config
{
    protected $cache = array();
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    protected function load()
    {
        if (file_exists($this->filename)) {
            $this->cache = parse_ini_file($this->filename, true);
        }
    }

    public function get($name, $default = null)
    {
        if (empty($this->cache)) {
            $this->load();
        }

        $cfg = $this->cache;

        // convert 'dot.seperated.string.key' to array indexes
        // get('database.host') => $config['database']['host']

        $keys = explode('.', $name);
        foreach ($keys as $key) {
            if (isset($cfg[$key])) {
                $cfg = $cfg[$key];
            } else {
                return $default;
            }
        }

        return $cfg;
    }
}
