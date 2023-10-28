<?php
function encrypt($plain_text)
{
    $ciphering = "aes-256-cbc";
    $options = 0;
    $encryption_iv = '0813366793211357';
    $encryption_key = "IniKunciDecrypt";

    $encryption = openssl_encrypt(
        $plain_text,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );
    return $encryption;
}
