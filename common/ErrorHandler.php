<?php

namespace Common;

class ErrorHandler
{
    public function register()
    {
        set_error_handler(array($this, 'handler'));
    }

    function handler($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            return;
        }

        $errortypes = array(
            E_USER_ERROR    => 'ERROR',
            E_USER_WARNING  => 'WARNING',
            E_USER_NOTICE   => 'NOTICE',
        );

        if (isset($errortypes[$errno])) {
            $errmsg = $errortypes[$errno] . " [$errno] $errstr $errfile:$errline\n";
        } else {
            $errmsg = "Unknown error type: [$errno] $errstr $errfile:$errline\n";
        }

        error_log($errmsg, 3, __DIR__ . '/../var/logs/error.log');

        /* Don't execute PHP internal error handler */
        return true;
    }
}
