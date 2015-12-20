<?php

namespace Common;

class Password
{
    public static function encode($plainText)
    {
        $options = array('cost' => 12);
        
        return password_hash($plainText, PASSWORD_BCRYPT, $options);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash); 
    }
}
