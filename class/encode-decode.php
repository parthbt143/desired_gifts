<?php

use \Firebase\JWT\JWT;

$key = "abcsmnDFGfjfakfbJGHvGahsbfjgfJFVHjamNjs";
$original = array(
    'a', 'I', 'y', '~', 'Q', '8',
    'K', 'j', 'e', 's', 'm', '.',
    'x', 'N', 'l', 'O', 'T', 'A',
    '2', '+', 'J', 'M', 'n', 'h',
    'U', 'R', 'W', 'b', 'c', '0',
    't', '7', 'r', 'k', '1', 'o',
    'p', '=', '3', 'S', '$', '^',
    '*', '(', '9', 'd', 'B', '4',
    'u', 'q', 'C', 'D', 'g', '5',
    'E', 'F', '%', 'G', 'v', '!',
    'H', 'V', 'w', '_', 'L', 'z',
    'P', 'X', 'Z', ')', 'i', 'f',
    '@', '#', '`', '&', 'Y', '6',
    '-'
);

function myencoded($string, $diff) {
    global $original;
    $return = "";
    $string = str_split($string, 1);
    foreach ($string as $char) {
        $o_idx = (array_search($char, $original) - $diff);
        if ($o_idx < 0) {
            $o_idx = $o_idx + 79;
        } else if ($o_idx > 78) {
            $o_idx = $o_idx - 79;
        }
        $return .= $original[$o_idx];
    }
    return $return;
}

function mydecoded($string, $diff) {
    global $original;
    $return = "";
    $string = str_split($string, 1);
    foreach ($string as $char) {
        $o_idx = (array_search($char, $original) + $diff);
        if ($o_idx < 0) {
            $o_idx = $o_idx + 79;
        } else if ($o_idx > 78) {
            $o_idx = $o_idx - 79;
        }
        $return .= $original[$o_idx];
    }

    return $return;
}

function get_new_token($random_number) {
    global $key;
    $random = rand(0, 999999);
    $token = array(
        "random" => "$random"
    );
    $jwt = JWT::encode($token, $key);
    $encoded = myencoded($jwt);
    $data = array(
        "jwt_token" => $jwt,
        "my_token" => $encoded
    );
    updatedata($data, "tbl_tokens", "random_number = '{$random_number}'");
    return $encoded;
}
