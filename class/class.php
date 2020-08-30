
<?php
  
session_start(); 
$page_title = "Desired Gift";
include 'connection.php';
include 'crud-operations.php'; 
include 'image-operations.php';
include 'client-details.php';
include 'mail.php';
include 'toast.php'; 
//this function will return todays date 
function today_date() {
    return date('Y-m-d');
}


//this function will return current time 
function today_time() {
    return date('h:i:s');
}

//this  function will return current time stamp
function today_datetime() {
    return date('Y-m-d h:i:s');
}

//this function will change the format of date and time 
//1st argument will be format
//2nd argument will be date 
function change_date_format($format, $date) {
    return date($format, strtotime($date));
}

// this function will refresh the page 
// this can be used to stop Form Resubmmision in POST method
function refresh() {
    $page = $_SERVER['REQUEST_URI'];
//    $page = $_SERVER['PHP_SELF'];
    echo "<script>window.location='$page';</script>";
}

//this function will be used to redirect to the page 
function move($page) {
    echo "<script>window.location='$page';</script>";
}
 


function is_ajax_request() {
    return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
}


function escape_string($value) {
    global $connection;
    $value = mysqli_real_escape_string($connection, $value);
    $value = trim($value);
    return $value;
}
 
function round_float($val) {

    $val = strval(floatval($val));
    if (strpos($val, ".")) {
        $val = number_format($val, 2);
    }
    return $val;
}

 
function get_setting($key)
{
    $array = array(
        "project_name" => "Desired Gift",
        "send_mail_from" => "gls.desiredgifts@gmail.com",
        "send_mail_from_password" => "Gls#123@"
    );
    return $array[$key];
            
}
 
function get_admindata($key)
{
    if(isset($_SESSION['admin_id']))
    {
        $admindata = get_single("select * from tbl_user where user_id = '{$_SESSION['admin_id']}'");
        return $admindata[$key];
    }else
    {
        return "No Data";
    }
}


function admin_auth()
{
    if(!isset($_SESSION['admin_id']))
    {
        move(admin_url()."login.php");
    }
}
 
function get_vendordata($key)
{
    if(isset($_SESSION['vendor_id']))
    {
        $vendordata = get_single("select * from tbl_user where user_id = '{$_SESSION['vendor_id']}'");
        return $vendordata[$key];
    }else
    {
        return "No Data";
    }
}

function vendor_auth()
{
    if(!isset($_SESSION['vendor_id']))
    {
        move(vendor_url()."login.php");
    }
}


function user_auth() 
{
     if(!isset($_SESSION['user_auth']))
    {
        move(user_url()."index.php");
    }
}

function get_custdata($key)
{
    if(isset($_SESSION['cust_id']))
    {
        $custdata = get_single("select * from tbl_user where user_id = '{$_SESSION['cust_id']}'");
        return $custdata[$key];
    }else
    {
        return "No Data";
    }
}


function get_product_details($id=NULL)
{
    if($id==NULL){
        $product=get_all("select * from tbl_product where is_delete='0'");
    }
    else{
        $product=get_single("select * from tbl_product where pro_id={$id} and is_delete='0'");
    }
    if(!isset($product) || empty($product)==true){
        return '0';
    }
        else{
        return $product;
    }
}

function get_product_image_size($pid,$pis_id=NULL){

    if(isset($pid) && $pid!=NULL){
        $product_img_dtls=get_all("select * from tbl_product_image_size where pro_id={$pid}");        
    }
    else if(isset($pis_id) && $pis_id!=NULL){
        $product_img_dtls=get_all("select * from tbl_product_image_size where pis_id={$pis_id}");
    }
    return $product_img_dtls;
}

if(isset($_POST['flag']) && $_POST['flag'] == "logout" ){
    unset($_SESSION['cust_id']);
    // move('index.php');
}

function get_logo()
{
    return upload_url()."logo.png";
}