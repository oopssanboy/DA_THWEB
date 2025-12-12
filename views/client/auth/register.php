<?php
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../../../autoload.php';
$user = $_POST['user']??'';
$pass = $_POST['pass']??'';
$passconfirm = $_POST['passconfirm']??'';
if ($pass != $passconfirm || empty($user) || empty($pass)){
    header('location:register.html');
    exit;
}else{
    
    $DB = new DB();
    $sql = "select * from users where username = ? and password = ?";
    $data = $DB->select($sql, [$user, $pass]);
    if(count($data) > 0){
        header('location:login.html');
        exit;
    }
    $sql = "insert into users(username, password) VALUES (?,?)";
    $data = $DB->insert($sql, [$user, $pass])[0];
    
    header('location:login.html');
    exit;
    
}

?>