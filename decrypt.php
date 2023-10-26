<?php

function decrypt($cipherText)
{
    $ciphering = "aes-256-cbc";
    $options = 0;
    $decryption_iv = '0813366793211357';
    $decryption_key = "GeeksforGeeks";

    $decryption = openssl_decrypt(
        $cipherText,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    return $decryption;
}
