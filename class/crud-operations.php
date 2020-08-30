<?php
// function for insert operation
// 1st Argument will be an array of database field name and value as key->value 
// and 2nd argument will be the name of table
function insertdata($data, $tbl) {
    global $connection;
    $query = "insert into " . $tbl . " (";
    $count = count($data);
    $i = 1;
    $val = "";
    foreach ($data as $key => $value) { 
        if ($i < $count) {
            $query .= $key . ",";
            $val .= "'" . $value . "'" . " ,";
            $i++;
        } else {
            $query .= $key . ") values (";
            $val .= "'" . $value . "' )";
        }
    }
    $query .= $val;
    $insert = mysqli_query($connection, $query);
    return mysqli_insert_id($connection);
   // return $query;
}

//function for fetching single record  as array
function get_single($sql) {
    global $connection;
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($query);
    return $row;
}

// function returns multiple records as multidimentional array 
function get_all($sql) {
    global $connection;
    $query = mysqli_query($connection, $sql);
    $result = array();
    while ($row = mysqli_fetch_array($query)) {
        $result[] = $row;
    }
    return $result;
}

function hard_delete($query) {
    global $connection;
    mysqli_query($connection, $query);
    return 1;
}

//update data of a table record 
//1st Argument will be an array of database field name and value as key->value
//2nd argument will be the name of the table 
//third argument will be the condition where 

function updatedata($data, $tbl, $where) {
    global $connection;
    $query = "update $tbl set ";
    $val = "";
    $count = count($data);
    $i = 1;
    foreach ($data as $key => $value) {
//        $value = mysqli_real_escape_string($connection, $value);
        if ($i < $count) {
            $val .= "  $key = '$value' , ";
        } else {
            $val .= "  $key = '$value'  ";
        }
        $i++;
    }
    $query .= $val . " where " . $where;
    $in = mysqli_query($connection, $query);
    return $in;
//    return $query;
}

//this function will return the next auto increment id of the table 
function next_auto_increment_id($tbl) {
    $result = get_single("show table status like '$tbl' ");
    return $result['Auto_increment'];
}

//this function will return all the field of the table 
function get_tbl_fields($tbl) {
    $query = get_all("show COLUMNS from $tbl");
    $column = array();
    foreach ($query as $query) {
        $column[] = $query['Field'];
    }
    return $column;
}

function soft_delete($tbl,$pk,$id){
    global $connection;
    $delete = mysqli_query($connection, "update $tbl set is_delete = '1' where $pk = $id ");
    if($delete){
        return true;
    }else{
        return false;        
    }
}

// this function will return the changes made in the record after the update 
// 1st argument will be the name of the table 
// 2nd argument will be the array of old record
// 3rd argument will be the array of new record
function changes($tbl, $old, $new) {
    global $connection;

    $fields = get_tbl_fields($tbl);

    $changes = "";
    foreach ($fields as $fields) {
        if ($old[$fields] != $new[$fields]) {
            $changes .= $fields . " :- " . $old[$fields] . " Changed To " . $new[$fields] . "<br>";
        }
    }
    return $changes;
}

function last_id($tbl, $key) {
    global $connection;
    $ar = get_single("select $key as total from $tbl order by $key desc limit 1");
    return $ar['total'];
}


function is_exist($data, $tbl){
    global $connection;
    $query = "select * from $tbl where ";
    $val = "";
    $count = count($data);
    $i = 1;
    foreach ($data as $key => $value) {
        if ($i < $count) {
            $val .= "  $key = '$value' and ";
        } else {
            $val .= "  $key = '$value'  ";
        }
        $i++;
    }
    $query .= $val.";" ;
    $res=mysqli_query($connection,$query);
    $row=mysqli_fetch_row($res);
    if(@$row[0] >= 1) {
        $flag=1;
      } else {
        $flag=0;
    }
    return $flag;
}
