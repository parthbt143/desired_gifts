<?php

function toast_success_alert($data) {
    echo "<div></div>";
    echo "<script>toast_success_alert('$data')</script>";
}

function toast_danger_alert($data) {
    echo "<div></div>";
    echo "<script>toast_danger_alert('$data')</script>";
}

function danger_sweet_alert($data) {
    
    echo "<div></div>";
    echo "<script>danger_sweet_alert('$data')</script>";
}

function success_sweet_alert($data) {
    echo "<div></div>";
    echo "<script>success_sweet_alert('$data')</script>";
}

function set_toast($type, $msg) {
    $_SESSION['msg_type'] = $type;
    $_SESSION['msg'] = $msg;
}

function set_sweet_alert($type, $msg) {
    $_SESSION['alert_type'] = $type;
    $_SESSION['alert_msg'] = $msg;
}

function print_toast() {
    if (isset($_SESSION['msg_type'])) {

        if ($_SESSION['msg_type'] == 1) {
            toast_success_alert($_SESSION['msg']);
        } else if ($_SESSION['msg_type'] == 2) {
            toast_danger_alert($_SESSION['msg']);
        }
    }
    $_SESSION['msg_type'] = 0;
    $_SESSION['msg'] = "";
}

function print_sweet_alert() {
     
    if (isset($_SESSION['alert_type'])) {

        if ($_SESSION['alert_type'] == 1) {
            success_sweet_alert($_SESSION['alert_msg']);
        } else if ($_SESSION['alert_type'] == 2) {
            danger_sweet_alert($_SESSION['alert_msg']);
        }
    }
    $_SESSION['alert_type'] = 0;
    $_SESSION['alert_msg'] = "";
}

function test_toast($type = 1, $msg = "ok it worked") {
    set_msg($type, $msg);
    print_toast();
}
?>

