<?php

//this function will upload the compressed image
function compress_img($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);
}

function get_filename($file, $name, $thumb = 0) {
    $name = escape_string($name);
    $name = str_replace(" ", "-", $name);
    $name = str_replace("'", "", $name);
    $name = str_replace("\\", "", $name);
    $name = str_replace("/", "", $name);
    if ($thumb == 1) {
        $name = $name . "-thumb";
    }
    $time = date('-h-i-s-d-m-Y', time()) . rand(1111, 9999);
    $filename = preg_replace("/-+/", "-", $name . $time . "." . pathinfo($file, PATHINFO_EXTENSION));
    return strtolower($filename);
}

function upload_image($filename, $uploadname, $path, $thumb = 0) {
    $file = str_replace("'", "", $_FILES[$filename]['name']);
    if (filesize($_FILES[$filename]['tmp_name']) != 0) {
        $img_name = get_filename($file, $uploadname);
        $thumb_name = get_filename($file, $uploadname, 1);
        if ($thumb == 1) {
            compress_img($_FILES[$filename]['tmp_name'], $path . $thumb_name, 50);
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    return $names;
}

function upload_image_multiple($filename, $i, $uploadname, $path, $thumb = 0) {
    $file = str_replace("'", "", $_FILES[$filename]['name'][$i]);
    if (filesize($_FILES[$filename]['tmp_name'][$i]) != 0) {
        $img_name = get_filename($file, $uploadname);
        $thumb_name = get_filename($file, $uploadname, 1);
        if ($thumb == 1) {
            compress_img($_FILES[$filename]['tmp_name'][$i], $path . $thumb_name, 50);
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'][$i], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    return $names;
}

function upload_image_edit($filename, $uploadname, $path, $old_img, $old_thumb = "no-image.png", $thumb = 0) {
    $file = str_replace("'", "", $_FILES[$filename]['name']);
    if (filesize($_FILES[$filename]['tmp_name']) != 0) {
        $img_name = get_filename($file, $uploadname);
        $thumb_name = get_filename($file, $uploadname, 1);
        if ($thumb == 1) {
            compress_img($_FILES[$filename]['tmp_name'], $path . $thumb_name, 50);
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    if ($names[0] == "no-image.png") {
        $return = array($old_img, $old_thumb);
    } else {
        if (file_exists($path . $old_thumb)) {
            unlink($path . $old_thumb);
        }
        if (file_exists($path . $old_img)) {
            unlink($path . $old_img);
        }
        $return = array($img_name, $thumb_name);
    }
    return $return;
}

function upload_image_edit_multiple($filename, $i, $uploadname, $path, $old_img, $old_thumb = "no-image.png", $thumb = 0) {
    $file = str_replace("'", "", $_FILES[$filename]['name'][$i]);
    if (filesize($_FILES[$filename]['tmp_name'][$i]) != 0) {
        $img_name = get_filename($file, $uploadname);
        $thumb_name = get_filename($file, $uploadname, 1);
        if ($thumb == 1) {
            compress_img($_FILES[$filename]['tmp_name'][$i], $path . $thumb_name, 50);
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'][$i], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    if ($names[0] == "no-image.png") {
        $return = array($old_img, $old_thumb);
    } else {
        if (file_exists($path . $old_thumb)) {
            unlink($path . $old_thumb);
        }
        if (file_exists($path . $old_img)) {
            unlink($path . $old_img);
        }
        $return = array($img_name, $thumb_name);
    }
    return $return;
}

function get_image($url = "default") {
    if (file_exists($url)) {
        return $url;
    } else {
        return upload_url() . "default.png";
    }
}

function check_image($url = "default") {

    $file_headers = get_headers($url);
    if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return upload_url() . "default.png";
    } else {
        return $url;
    }
}

function endsWith($string, $endString) {
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}
