<?php
setcookie("path", "", time() - 60, "/","", 0);
require './inc/all.php';
if(login()){
    unset($_SESSION['logged']);
    $path = $_COOKIE['path'];
    $sql = "DELETE FROM cookie WHERE path = '$path'";
    $conn->query($sql);
    header("Location: /");
}else{
    header("Location: /dangnhap");
}
?>