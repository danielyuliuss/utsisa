<?php

// function decrypt($cipherText)
// {
//     $ciphering = "AES-128-CTR";
//     // Store the decryption key
//     $decryption_key = "GeeksforGeeks";

//     // Use openssl_decrypt() function to decrypt the data
//     $decryption = openssl_decrypt(
//         $cipherText,
//         $ciphering,
//         $decryption_key
//     );

//     return $decryption;
// }

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
