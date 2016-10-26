<?php

    /**
     * Hash the given string
     * @param [string] $string - This will generate a hashed string
     *
     * to decript you must use password_verify($string, $string_hashed)
     */
    function HashString($string){
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        return password_hash($string, PASSWORD_BCRYPT, $options);
    }
?>