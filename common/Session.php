<?php

namespace Common;

class Session
{
    public function start()
    {
        session_save_path(__DIR__ . '/../var/sessions/');
        session_start();
    }

    public function destroy()
    {
        session_destroy();
        $_SESSION = array();
    }

    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
}
